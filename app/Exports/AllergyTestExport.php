<?php

namespace App\Exports;

use App\Models\AllergyTest;
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
        return AllergyTest::all();
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
