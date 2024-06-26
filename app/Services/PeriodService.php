<?php

namespace App\Services;

use App\Repositories\PeriodRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PeriodService
{
    private PeriodRepository $repository;

    public function __construct(PeriodRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all data paginated.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        return $this->repository->all();
    }

    /**
     * Get a specific data by id.
     *
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return $this->repository->show($id);
    }

    /**
     * Create a new data.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    /**
     * Update a specific data by id.
     *
     * @param array $data
     * @param int $id
     *
     * @return Model
     */
    public function update(array $data, int $id): Model
    {
        return $this->repository->update($data, $id);
    }

    /**
     * Delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    /**
     * Force delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool
    {
        return $this->repository->forceDelete($id);
    }

    /**
     * Restore a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool
    {
        return $this->repository->restore($id);
    }
}
