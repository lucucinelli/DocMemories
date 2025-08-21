<?php

namespace App\Exports;

use App\Models\PhysiologicalHistory;
use Illuminate\Support\Facades\Auth;
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
        return PhysiologicalHistory::select('physiological_histories.*')
            ->join('patients', 'physiological_histories.patient_id', '=', 'patients.id')
            ->where('patients.user_id', Auth::id())->get();
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
            'enclosure' => '"',
            'line_ending' => "\r\n",
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
