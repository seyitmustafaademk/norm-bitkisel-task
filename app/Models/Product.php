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

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->using(OrderProduct::class)
            ->withPivot('quantity', 'price', 'discount')
            ->withTimestamps();
    }

    public function basketProducts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BasketProduct::class);
    }

    public function campaigns(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'campaign_period_products')
            ->using(CampaignPeriodProduct::class)
            ->withPivot('period_id');
    }
}
