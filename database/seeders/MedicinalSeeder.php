<?php

namespace Database\Seeders;

use App\Models\Medicinal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicinalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Medicinal::factory()->count(100)->create();
    }
}
