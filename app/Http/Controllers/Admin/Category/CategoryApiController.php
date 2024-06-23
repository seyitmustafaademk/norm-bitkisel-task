<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Http\Resources\Admin\Category\CategoryResourceCollection;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    private CategoryService $category_service;

    public function __construct(CategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    /**
     * Display a listing of the resource.
     *
     * This method uses the 'per_page' and 'page' GET parameters to determine
     * how many items to display per page and which page to display.
     *
     * @return CategoryResourceCollection|JsonResponse
     */
    public function index()
    {
        try {
            $categories = $this->category_service->all();

            return new CategoryResourceCollection($categories);
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
     * @return CategoryResource|JsonResponse
     */
    public function show(int $id)
    {
        try {
            $category = $this->category_service->show($id);

            return new CategoryResource($category);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $category = $this->category_service->create($data);

            return new CategoryResource($category);
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
     * @return CategoryResource|JsonResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $category = $this->category_service->update($data, $id);

            return new CategoryResource($category);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Category not found'
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
            $this->category_service->delete($id);

            return response()->json([
                'message' => 'Category deleted successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Category not found'
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
            $this->category_service->forceDelete($id);

            return response()->json([
                'message' => 'Category permanently deleted'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Category not found'
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
            $this->category_service->restore($id);

            return response()->json([
                'message' => 'Category restored successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
