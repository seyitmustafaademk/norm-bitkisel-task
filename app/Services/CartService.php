<?php

namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CartService
{
    private CartRepository $repository;

    public function __construct(CartRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get the basket products for the user.
     *
     * @return Collection
     */
    public function getBasketProducts(): Collection
    {
        return $this->repository->getBasketProducts();
    }

    /**
     * Increase quantity of product in basket.
     *
     * @param int $id
     * @return bool
     */
    public function increaseQuantity(int $id): bool
    {
        return $this->repository->increaseQuantity($id);
    }

    /**
     * Decrease quantity of product in basket.
     *
     * @param int $id
     * @return bool
     */
    public function decreaseQuantity(int $id): bool
    {
        return $this->repository->decreaseQuantity($id);
    }

    /**
     * Remove product from basket.
     *
     * @param int $id
     * @return bool
     */
    public function removeProduct(int $id): bool
    {
        return $this->repository->removeProduct($id);
    }

    /**
     * Add product to basket.
     *
     * @param int $id
     * @return bool
     */
    public function addProduct(int $id): bool
    {
        return $this->repository->addProduct($id);
    }
}
