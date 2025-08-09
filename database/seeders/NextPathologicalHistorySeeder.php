<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NextPathologicalHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NextPathologicalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NextPathologicalHistory::factory()->count(300)->create();
    }
}
