<?php

namespace App\Exports;

use App\Models\NextPathologicalHistory;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class NextPathologicalHistryExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return NextPathologicalHistory::all();
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
            'date',
            'type',
            'name',
            'cause',
            'effect',
            'note',
            'patient_id',
            'Created_At',
            'Updated_At',
        ];
    }
}
