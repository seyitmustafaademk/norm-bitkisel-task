<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periods = Period::all();

        $products = Product::all();

        $periods->each(function (Period $period) use ($products) {
            $period->periodProducts()->attach($products->random(rand(1, 5))->pluck('id'));
        });
    }
}
