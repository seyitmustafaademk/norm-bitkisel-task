<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketProduct extends Model
{
    protected $table = 'basket_products';
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
