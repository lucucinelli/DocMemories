<?php

namespace App\Exports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ExamExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Exam::all();
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
            'note',
            'result',
            'visit_id',
            'Created_At',
            'Updated_At',
        ];
    }
}
