<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignDetail extends Model
{
    protected $table = 'campaign_details';
    protected $fillable = [
        'campaign_id',
        'gift_product_id',
        'period_id',
        'discount_percentage',
        'discount_amount',
        'min_purchase_amount',
    ];
    protected $casts = [
        'discount_percentage' => 'decimal:4',
        'discount_amount' => 'decimal:10',
        'min_purchase_amount' => 'decimal:10',
    ];

    /**
     * Get the campaign for the campaign detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function campaign(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    /**
     * Get the gift product for the campaign detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function giftProduct(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class, 'gift_product_id');
    }

    /**
     * Get the period for the campaign detail.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Period::class);
    }
}
