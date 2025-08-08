<?php

namespace Database\Seeders;

use App\Models\AllergyTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergyTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AllergyTest::factory()->count(100)->create();
    }
}
