<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Http\Requests\Admin\Product\UploadProductImageRequest;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Http\Resources\Admin\Product\ProductResourceCollection;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    private ProductService $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    /**
     * Display a listing of the resource.
     *
     * This method uses the 'per_page' and 'page' GET parameters to determine
     * how many items to display per page and which page to display.
     *
     * @return ProductResourceCollection|JsonResponse
     */
    public function index(): ProductResourceCollection|JsonResponse
    {
        try {
            $products = $this->product_service->all();

            return new ProductResourceCollection($products);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return ProductResource|JsonResponse
     */
    public function show(int $id): ProductResource|JsonResponse
    {
        try {
            $product = $this->product_service->show($id);

            return new ProductResource($product);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductResource|JsonResponse
     */
    public function store(StoreRequest $request): ProductResource|JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->product_service->create($data);

            return new ProductResource($product);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     *
     * @return ProductResource|JsonResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $product = $this->product_service->update($data, $id);

            return new ProductResource($product);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * The item has been marked as deleted in the storage area.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->product_service->delete($id);

            return response()->json([
                'message' => 'Product deleted successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Force delete the specified resource from storage.
     * This method will permanently delete the item from the storage area.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function forceDelete(int $id): JsonResponse
    {
        try {
            $this->product_service->forceDelete($id);

            return response()->json([
                'message' => 'Product permanently deleted'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Restore the specified resource from storage.
     * This method will restore the item from the storage area.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        try {
            $this->product_service->restore($id);

            return response()->json([
                'message' => 'Product restored successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Update product image.
     *
     * @param UploadProductImageRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateImage(UploadProductImageRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated();

            $product = $this->product_service->updateImage($data, $id);

            return response()->json([
                'message' => 'Product image updated successfully',
                'data' => new ProductResource($product)
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}

