<?php

namespace App\Repositories;

use App\Interfaces\IRepository;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements IRepository
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

        return Product::with('category')->paginate(perPage: $per_page, page: $page);
    }

    /**
     * Get a specific data by id.
     *
     * @param int $id
     * @return Model
     */
    public function show(int $id): Model
    {
        return Product::with('category')->findOrFail($id);
    }

    /**
     * Create a new data.
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return Product::create([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'description' => $data['description'],
            'stock' => $data['stock'],
            'price' => $data['price'],
            'image' => $data['image'],
            'status' => $data['status'],
            'slug' => $data['slug'],
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
        $product = Product::findOrFail($id);

        $product->category_id = $data['category_id'];
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->stock = $data['stock'];
        $product->price = $data['price'];
        $product->status = $data['status'];
        $product->slug = $data['slug'];

        if ($product->isDirty()) {
            $product->save();
        }

        return $product;
    }

    /**
     * Delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);

        return $product->delete();
    }

    /**
     * Force delete a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        return $product->forceDelete();
    }

    /**
     * Restore a specific data by id.
     *
     * @param int $id
     * @return bool
     */
    public function restore(int $id): bool
    {
        $product = Product::onlyTrashed()->findOrFail($id);

        return $product->restore();
    }

    /**
     * Update product image.
     *
     * @param int $id
     * @param string $image_path
     * @return Model
     */
    public function updateProductImage(Product $product, string $image_path): Model
    {
        $product->image = $image_path;

        if ($product->isDirty()) {
            $product->save();
        }

        return $product;
    }
}
