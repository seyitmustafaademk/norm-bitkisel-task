<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
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
        $data['slug'] = \Str::slug($data['slug']);

        try {
            $data['image'] = \Storage::disk('public')->putFile('uploads/products', $data['image']);

            if (!$data['image']) {
                throw new \Exception('Failed to upload image');
            }

            return $this->repository->create($data);
        } catch (\Exception $ex) {
            if (\Storage::disk('public')->exists($data['image'])) {
                \Storage::disk('public')->delete($data['image']);
            }

            throw $ex;
        }
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
        $data['slug'] = \Str::slug($data['slug']);

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

    /**
     * Update product image.
     *
     * @param array $data
     * @param int $id
     * @return Model
     * @throws \Exception
     */
    public function updateImage(array $data, int $id): Model
    {
        $product = $this->repository->show($id);

        $old_image = $product->image;

        try {
            $image_path = \Storage::disk('public')->putFile('uploads/products', $data['image']);
            if (!$image_path) {
                throw new \Exception('Failed to upload image');
            }

            $product = $this->repository->updateProductImage($product, $image_path);

            if (\Storage::disk('public')->exists($old_image)) {
                \Storage::disk('public')->delete($old_image);
            }

            return $product;
        } catch (\Exception $ex) {
            // Hata durumunda yeni yüklenen resim silinir
            if (\Storage::disk('public')->exists($image_path)) {
                \Storage::disk('public')->delete($image_path);
            }

            throw $ex;
        }
    }

    /**
     * Get products by category id.
     *
     * @param int $categoryId
     * @return LengthAwarePaginator
     */
    public function getWhereCategoryId(int $categoryId): LengthAwarePaginator
    {
        $page = request()->query('page', 1);

        return $this->repository->getWhereCategoryId($categoryId, $page);
    }
}
