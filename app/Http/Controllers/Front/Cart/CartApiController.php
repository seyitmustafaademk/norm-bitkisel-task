<?php

namespace App\Http\Controllers\Front\Cart;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartApiController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function getBasketProducts()
    {
        $basket_products = $this->cartService->getBasketProducts();

        return response()->json([
            'status' => 'success',
            'data' => $basket_products
        ]);
    }

    /**
     * Increase quantity of product in basket.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function increaseQuantity(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->cartService->increaseQuantity($id);

        if (!$result) {
            return response()->json([
                'status' => 'error',
                'message' => 'Quantity could not be increased'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Quantity increased successfully'
        ]);
    }

    /**
     * Decrease quantity of product in basket.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function decreaseQuantity(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->cartService->decreaseQuantity($id);

        if (!$result) {
            return response()->json([
                'status' => 'error',
                'message' => 'Quantity could not be decreased'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Quantity decreased successfully'
        ]);
    }

    /**
     * Remove product from basket.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeProduct(int $id): \Illuminate\Http\JsonResponse
    {
        $result = $this->cartService->removeProduct($id);

        if (!$result) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product could not be removed'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product removed successfully'
        ]);
    }

    /**
     * Add product to basket.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addProduct(int $id)
    {
        $result = $this->cartService->addProduct($id);

        if (!$result) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product could not be added'
            ], 400);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Product added successfully'
        ]);
    }
}
