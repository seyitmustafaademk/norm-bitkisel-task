<?php

namespace App\Http\Controllers\Front\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class HomepageApiController extends Controller
{
    public function getCategories(CategoryService $categoryService)
    {
        try {
            $categories = $categoryService->allWithoutPaginate();

            return response()->json([
                'message' => 'Categories listed',
                'data' => [
                    'categories' => $categories,
                ],
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $ex->getMessage(),
            ], 500);
        }
    }

    public function getProducts(CategoryService $categoryService, ProductService $productService)
    {
        try {
            $category = request()->query('category');

            if ($category) {
                $category = $categoryService->findBySlug($category);
                $products = $productService->getWhereCategoryId($category->id);
            } else {
                $products = $productService->all();
            }

            return response()->json([
                'message' => 'Products listed',
                'data' => [
                    'products' => $products,
                ],
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
