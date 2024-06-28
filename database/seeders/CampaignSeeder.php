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
                'started_at' => now()->firstOfYear(),
                'ended_at' => now()->lastOfYear(),
                'is_active' => true,
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
