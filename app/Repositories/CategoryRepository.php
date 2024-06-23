<?php

namespace App\Repositories;

use App\Interfaces\IRepository;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements IRepository
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
        return Category::paginate(perPage: $per_page, page: $page);
    }

    /**
     * Get a specific data by id.
     *
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return Category::findOrFail($id);
    }

    /**
     * Create a new data.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return Category::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'slug' => $data['slug']
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
        $category = Category::findOrFail($id);
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->slug = $data['slug'];

        if ($category->isDirty()) {
            $category->save();
        }

        return $category;
    }

    /**
     * Delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $category = Category::findOrFail($id);

        return $category->delete();
    }

    /**
     * Force delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool
    {
        $category = Category::withTrashed()->findOrFail($id);

        return $category->forceDelete();
    }

    /**
     * Restore a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        return $category->restore();
    }
}
