<?php

namespace Database\Seeders;

use App\Models\FamiliarHistory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FamiliarHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FamiliarHistory::factory()->count(100)->create();
    }
}
