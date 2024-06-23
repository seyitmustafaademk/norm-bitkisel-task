<?php

namespace App\Models;

use App\Enums\CampaignTypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    protected $table = 'campaigns';
    protected $fillable = [
        'name',
        'description',
        'type',
        'min_basket_amount',
        'discount_rate',
        'started_at',
        'ended_at',
    ];
    protected $casts = [
        'type' => CampaignTypeEnum::class,
        'min_basket_amount' => 'decimal:2',
        'started_at' => 'datetime:Y-m-d H:i:s',
        'ended_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function periods(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Period::class, 'campaign_period_products')
            ->using(CampaignPeriodProduct::class)
            ->withPivot('product_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'campaign_period_products')
            ->using(CampaignPeriodProduct::class)
            ->withPivot('period_id');
    }
}
