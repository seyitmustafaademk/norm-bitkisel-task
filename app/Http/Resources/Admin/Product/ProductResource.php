<?php

namespace App\Http\Resources\Admin\Product;

use App\Http\Resources\Admin\Category\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
            'image' => $this->image,
            'status' => $this->status,
            'slug' => $this->slug,
            'category' => new CategoryResource($this->category),
        ];
    }
}
