<?php

namespace App\Repositories;

use App\Interfaces\IRepository;
use App\Models\Period;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PeriodRepository implements IRepository
{
    /**
     * Get all data paginated.
     *
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator
    {
        $per_page = request()->query('per_page', 25);
        $page = request()->query('page', 1);

        return Period::paginate(perPage: $per_page, page: $page);
    }

    /**
     * Get a specific data by id.
     *
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return Period::findOrFail($id);
    }

    /**
     * Create a new data.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return Period::create([
            'name' => $data['name'],
            'started_at' => $data['started_at'],
            'ended_at' => $data['ended_at'],
        ]);
    }

    /**
     * Update a specific data by id.
     *
     * @param array $data
     * @param int $id
     * @return Model
     */
    public function update(array $data, int $id): Model
    {
        $period = Period::findOrFail($id);
        $period->name = $data['name'];
        $period->started_at = $data['started_at'];
        $period->ended_at = $data['ended_at'];

        if ($period->isDirty()) {
            $period->save();
        }

        return $period;
    }

    /**
     * Delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $period = Period::findOrFail($id);

        return $period->delete();
    }

    /**
     * Force delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool
    {
        $period = Period::onlyTrashed()->findOrFail($id);

        return $period->forceDelete();
    }

    /**
     * Restore a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool
    {
        $period = Period::onlyTrashed()->findOrFail($id);

        return $period->restore();
    }
}
