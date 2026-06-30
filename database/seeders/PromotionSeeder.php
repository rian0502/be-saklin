<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
            [
                'code' => 'WELCOME10',
                'discount_type' => 'percentage',
                'value' => 10,
                'valid_from' => now()->toDateString(),
                'valid_until' => now()->addMonths(3)->toDateString(),
                'usage_limit' => 100,
                'used_count' => 0,
                'status' => 'active',
            ],
            [
                'code' => 'POTONGAN5K',
                'discount_type' => 'nominal',
                'value' => 5000,
                'valid_from' => now()->toDateString(),
                'valid_until' => now()->addMonth()->toDateString(),
                'usage_limit' => null, // unlimited
                'used_count' => 0,
                'status' => 'active',
            ],
        ];

        foreach ($promotions as $promotion) {
            Promotion::firstOrCreate(['code' => $promotion['code']], $promotion);
        }
    }
}
