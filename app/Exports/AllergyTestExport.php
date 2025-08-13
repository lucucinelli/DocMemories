<?php

namespace App\Exports;

use App\Models\AllergyTest;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class AllergyTestExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AllergyTest::select('allergy_tests.*')
                ->join('visits', 'allergy_tests.visit_id', '=', 'visits.id')
                ->where('visits.user_id', Auth::id())->get();
    }
    public function getCsvSettings(): array
    {
        return [
            'use_bom' => true,
        ];
    }
    public function headings(): array
    {
        return [
            'ID',
            'test_date',
            'test_type',
            'test_result',
            'test_note',
            'visit_id',
            'Created_At',
            'Updated_At',
        ];
    }
}
