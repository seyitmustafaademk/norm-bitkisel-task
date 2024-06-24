<?php

namespace App\Http\Controllers\Admin\Period;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Period\StoreRequest;
use App\Http\Requests\Admin\Period\UpdateRequest;
use App\Http\Resources\Admin\Category\CategoryResourceCollection;
use App\Http\Resources\Admin\Period\PeriodResource;
use App\Http\Resources\Admin\Period\PeriodResourceCollection;
use App\Services\PeriodService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PeriodApiController extends Controller
{
    private PeriodService $period_service;

    public function __construct(PeriodService $period_service)
    {
        $this->period_service = $period_service;
    }

    /**
     * Display a listing of the resource.
     *
     * This method uses the 'per_page' and 'page' GET parameters to determine
     * how many items to display per page and which page to display.
     *
     * @return PeriodResourceCollection|JsonResponse
     */
    public function index(): PeriodResourceCollection|JsonResponse
    {
        try {
            $periods = $this->period_service->all();

            return new PeriodResourceCollection($periods);
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
     * @return PeriodResource|JsonResponse
     */
    public function show(int $id)
    {
        try {
            $period = $this->period_service->show($id);

            return new PeriodResource($period);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Period not found'
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
     * @return PeriodResource|JsonResponse
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $period = $this->period_service->create($data);

            return new PeriodResource($period);
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
     * @return PeriodResource|JsonResponse
     */
    public function update(UpdateRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            $period = $this->period_service->update($data, $id);

            return new PeriodResource($period);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Period not found'
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
            $this->period_service->delete($id);

            return response()->json([
                'message' => 'Period deleted successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Period not found'
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
            $this->period_service->forceDelete($id);

            return response()->json([
                'message' => 'Period permanently deleted'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Period not found'
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
            $this->period_service->restore($id);

            return response()->json([
                'message' => 'Period restored successfully'
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Period not found'
            ], 404);
        } catch (\Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
