<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhysiologicalHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhysiologicalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhysiologicalHistory::factory()->count(100)->create();
    }
}
