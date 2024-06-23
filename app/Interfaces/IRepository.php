<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface IRepository
 *
 * IRepository is an interface that defines the methods that must be implemented by the repository classes.
 *
 * @package App\Interfaces
 */
interface IRepository
{
    /**
     * Get all data paginated.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator;

    /**
     * Get a specific data by id.
     *
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model;

    /**
     * Create a new data.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * Update a specific data by id.
     *
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id): Model;

    /**
     * Delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Force delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool;

    /**
     * Restore a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool;
}
