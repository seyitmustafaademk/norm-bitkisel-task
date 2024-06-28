<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodProduct extends Model
{
    protected $table = 'period_products';
    protected $fillable = [
        'period_id',
        'product_id',
    ];

    /**
     * Get the period for the period product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    /**
     * Get the product for the period product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
