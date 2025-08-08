<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RemotePathologicalHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RemotePathologicalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RemotePathologicalHistory::factory()->count(100)->create();
    }
}
