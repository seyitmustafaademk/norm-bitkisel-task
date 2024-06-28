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
        'started_at',
        'ended_at',
        'is_active',
    ];
    protected $casts = [
        'type' => CampaignTypeEnum::class,
        'started_at' => 'datetime:Y-m-d H:i:s',
        'ended_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the campaign details for the campaign.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaignDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CampaignDetail::class);
    }

    /**
     * The users that belong to the campaign.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function usedCampaignUser(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_campaigns')
            ->withPivot('redeemed_at');
    }
}
