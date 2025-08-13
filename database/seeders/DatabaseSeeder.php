<?php

namespace Database\Seeders;

use App\Exports\ExamExport;
use App\Models\FamiliarHistory;
use App\Models\User;
use App\Models\Visit;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create();
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);


        $this->call([
            PatientSeeder::class,
            VisitSeeder::class,
            PhysiologicalHistorySeeder::class,
            FamiliarHistorySeeder::class,
            RemotePathologicalHistorySeeder::class,
            NextPathologicalHistorySeeder::class,
            AllergyTestSeeder::class,
            MedicinalSeeder::class,
            ExamSeeder::class,
        ]);
    }
}
