<?php

namespace Database\Seeders;

use App\Enums\CampaignTypeEnum;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $campaigns = [
            [
                'name' => 'Hoş Geldin Kampanyası',
                'description' => 'Yeni üyelere özel hoş geldin kampanyası',
                'type' => CampaignTypeEnum::WELCOME,
                'min_basket_amount' => 250.00,
                'discount_rate' => null,
                'started_at' => now()->firstOfYear(),
                'ended_at' => now()->lastOfYear(),
            ],
            [
                'name' => 'Yılbaşı İndirimi',
                'description' => 'Yılbaşında seçili ürünlerde %20 indirim',
                'type' => CampaignTypeEnum::BASKET_DISCOUNT,
                'min_basket_amount' => 100.00,
                'discount_rate' => 10.00,
                'started_at' => Carbon::create(2024, 12, 1, 0, 0, 0),
                'ended_at' => Carbon::create(2024, 12, 31, 23, 59, 59),
            ],
        ];

        if (Campaign::count() > 0) {
            return;
        }

        foreach ($campaigns as $campaign) {
            Campaign::create($campaign);
        }
    }
}
