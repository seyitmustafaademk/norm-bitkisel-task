<?php

namespace App\Repositories;

use App\Enums\CampaignTypeEnum;
use App\Models\BasketProduct;
use App\Models\Campaign;
use App\Models\Order;
use App\Models\Period;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartRepository
{
    /**
     * Get the basket products for the user.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBasketProducts(): \Illuminate\Database\Eloquent\Collection
    {
        $basket_products = Auth::user()->basketProducts()->get();

        foreach ($basket_products as $key => $basket_product) {
            $basket_products[$key]->total_price = $basket_product->price * $basket_product->pivot->quantity;
            $basket_products[$key]->quantity = $basket_product->pivot->quantity;

        }

        return $basket_products;
    }

    /**
     * Increase quantity of product in basket
     *
     * @param int $id
     * @return bool
     */
    public function increaseQuantity(int $id): bool
    {
        // Increase quantity of product in basket
        $basket_product = BasketProduct::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();

        if ($basket_product) {
            $basket_product->quantity++;
            $basket_product->save();

            return true;
        }

        return false;
    }

    /**
     * Decrease quantity of product in basket
     *
     * @param int $id
     * @return bool
     */
    public function decreaseQuantity(int $id): bool
    {
        // Decrease quantity of product in basket
        $basket_product = BasketProduct::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();

        if ($basket_product) {
            $basket_product->quantity--;

            if ($basket_product->quantity == 0) {
                $this->removeProduct($basket_product->product_id);
                return true;
            }

            $basket_product->save();
            return true;
        }

        return false;
    }

    /**
     * Remove product from basket
     *
     * @param int $id
     * @return bool
     */
    public function removeProduct(int $id): bool
    {
        $basket_product = BasketProduct::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();

        if (!$basket_product) {
            return false;
        }
        Auth::user()->basketProducts()->detach($id);

        return true;
    }

    /**
     * Add product to basket
     *
     * @param int $id
     * @return bool
     */
    public function addProduct(int $id): bool
    {
        // Add product to basket
        $product = Product::where('id', $id)->exists();

        if (!$product) {
            return false;
        }

        $basket_product = BasketProduct::where('user_id', Auth::user()->id)
            ->where('product_id', $id)
            ->first();

        if ($basket_product) {
            $basket_product->quantity++;
            $basket_product->save();
            return true;
        }

        $new_basket_product = BasketProduct::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'quantity' => 1
        ]);

        if ($new_basket_product->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Get the welcome campaign
     *
     * @return Model|null
     */
    public function getWelcomeCampaign(): ?Model
    {
        // Get the welcome campaign
        $campaign = Campaign::with('campaignDetails')
            ->where('type', CampaignTypeEnum::WELCOME)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->where('started_at', '<=', Auth::user()->created_at)
                    ->where('ended_at', '>=', Auth::user()->created_at);
            })
            ->whereDoesntHave('usedCampaignUser', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->first();

        if (!$campaign) {
            return null;
        }

        $period_products = Period::with('periodProducts')
            ->where(function ($query) {
                $query->where('started_at', '<=', Auth::user()->created_at)
                    ->where('ended_at', '>=', Auth::user()->created_at);
            })
            ->first();

        $campaign->period_products = $period_products;

        return $campaign;
    }

    /**
     * Checkout the basket
     *
     * @return array
     */
    public function checkout(): array
    {
        try {
            DB::beginTransaction();

            // sepet ürünlerini alıyoruz yoksa hata dönecek
            $basket_products = Auth::user()->basketProducts()->get();
            if ($basket_products->isEmpty()) {
                throw new \ValueError('Basket is empty');
            }

            // kullanıcının hoşgeldin kampanyasını kullandı olarak kaydediyoruz
            $campaign = $this->getWelcomeCampaign();
            if ($campaign) {
                $campaign->usedCampaignUser()->attach(Auth::user()->id, [
                    'redeemed_at' => now()
                ]);
            }

            // sipariş oluşturuyoruz
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->uuid = Str::uuid();
            $order->amount = 0;
            $order->save();


            $total_price = 0;
            foreach ($basket_products as $basket_product) {
                // stok kontrolü yapıyoruz
                if ($basket_product->stock < $basket_product->pivot->quantity) {
                    throw new \ValueError("'{$basket_product->name}' has insufficient stock. Stock: {$basket_product->stock}");
                }
                // stoktan düşüyoruz
                $basket_product->stock -= $basket_product->pivot->quantity;
                $basket_product->save();

                // toplam fiyatı hesaplıyoruz
                $total_price += $basket_product->price * $basket_product->pivot->quantity;

                // kullanıcının ürünlerini order tablosuna ekliyoruz.
                $order->products()->attach($basket_product->id, [
                    'quantity' => $basket_product->pivot->quantity,
                    'price' => $basket_product->price
                ]);
            }
            // toplam fiyatı order tablosuna ekliyoruz.
            $order->amount = $total_price;
            $order->save();

            // hediye ürünlerin eklenmesi
            if ($campaign) {
                foreach ($campaign->period_products->periodProducts as $period_product) {
                    // stok kontrolü yapıyoruz
                    if ($period_product->stock < $period_product->pivot->quantity) {
                        throw new \ValueError("'{$basket_product->name}' has insufficient stock. Stock: {$basket_product->stock}");
                    }

                    // stoktan düşüyoruz
                    $basket_product->stock -= $basket_product->pivot->quantity;
                    $basket_product->save();
                    $order->products()->attach($period_product->product_id, [
                        'quantity' => 1,
                        'price' => 0
                    ]);
                }
            }

            // kullanıcı sepetindeki ürünleri satın alma işlemi bittiği için kaldırıyoruz.
            Auth::user()->basketProducts()->detach();

            DB::commit();
            return [
                'status' => 'success',
                'message' => 'Basket checked out successfully'
            ];

        } catch (\ValueError $ex) {
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => $ex->getMessage()
            ];
        } catch (\Exception $ex) {
            DB::rollBack();
            return [
                'status' => 'error',
//                'message' => 'An error occurred while checking out the basket. Please try again later.'
                'message' => $ex->getMessage() . ' ' . $ex->getLine()
            ];
        }

    }
}
