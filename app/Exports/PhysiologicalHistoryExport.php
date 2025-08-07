<?php

namespace App\Exports;

use App\Models\PhysiologicalHistory;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PhysiologicalHistoryExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PhysiologicalHistory::all();
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
            'birth',
            'atopy',
            'nursing',
            'diet',
            'habits',
            'period',
            'period_regularity',
            'patient_id',
            'Created_At',
            'Updated_At',
        ];
    }
}
