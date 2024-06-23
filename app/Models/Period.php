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

    public function campaigns(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'campaign_period_products')
            ->using(CampaignPeriodProduct::class)
            ->withPivot('product_id');
    }
}
