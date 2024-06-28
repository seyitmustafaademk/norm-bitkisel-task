<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'stock',
        'price',
        'image',
        'status', // 1: active, 0: passive
        'slug',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get the category that owns the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the orders for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->using(OrderProduct::class)
            ->withPivot('quantity', 'price', 'discount')
            ->withTimestamps();
    }

    /**
     * Get the basket products for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function basketProducts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BasketProduct::class);
    }

    /**
     * Get the campaign details for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaignDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CampaignDetail::class);
    }
}
