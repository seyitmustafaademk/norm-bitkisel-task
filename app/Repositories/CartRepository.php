<?php

namespace App\Repositories;

use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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
}
