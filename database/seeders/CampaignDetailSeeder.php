<?php

namespace Database\Seeders;

use App\Enums\CampaignTypeEnum;
use App\Models\Campaign;
use App\Models\Period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campaign = Campaign::where('type', CampaignTypeEnum::WELCOME)->first();

        if (!$campaign) {
            return;
        }

        $periods = Period::all();

        $campaign->campaignDetails()->create([
            'campaign_id' => $campaign->id,
            'product_id' => null,
            'period_id' => $periods->random()->id,
            'discount_percentage' => null,
            'discount_amount' => null,
            'min_purchase_amount' => 500,
        ]);
    }
}
