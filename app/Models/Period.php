<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes;

    protected $table = 'periods';
    protected $fillable = [
        'name',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'started_at' => 'datetime:Y-m-d H:i:s',
        'ended_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the period products for the period.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function periodProducts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'period_products');
    }
}
