<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periods = [
            [
                'name' => 'Ocak Dönemi',
                'started_at' => now()->firstOfYear(),
                'ended_at' => now()->firstOfYear()->addMonth(),
            ],
            [
                'name' => 'Şubat Dönemi',
                'started_at' => now()->firstOfYear()->addMonth(),
                'ended_at' => now()->firstOfYear()->addMonths(2),
            ],
            [
                'name' => 'Mart Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(2),
                'ended_at' => now()->firstOfYear()->addMonths(3),
            ],
            [
                'name' => 'Nisan Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(3),
                'ended_at' => now()->firstOfYear()->addMonths(4),
            ],
            [
                'name' => 'Mayıs Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(4),
                'ended_at' => now()->firstOfYear()->addMonths(5),
            ],
            [
                'name' => 'Haziran Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(5),
                'ended_at' => now()->firstOfYear()->addMonths(6),
            ],
            [
                'name' => 'Temmuz Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(6),
                'ended_at' => now()->firstOfYear()->addMonths(7),
            ],
            [
                'name' => 'Ağustos Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(7),
                'ended_at' => now()->firstOfYear()->addMonths(8),
            ],
            [
                'name' => 'Eylül Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(8),
                'ended_at' => now()->firstOfYear()->addMonths(9),
            ],
            [
                'name' => 'Ekim Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(9),
                'ended_at' => now()->firstOfYear()->addMonths(10),
            ],
            [
                'name' => 'Kasım Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(10),
                'ended_at' => now()->firstOfYear()->addMonths(11),
            ],
            [
                'name' => 'Aralık Dönemi',
                'started_at' => now()->firstOfYear()->addMonths(11),
                'ended_at' => now()->lastOfYear(),
            ],
        ];

        if (Period::count() > 0) {
            return;
        }

        foreach ($periods as $period) {
            Period::create($period);
        }
    }
}
