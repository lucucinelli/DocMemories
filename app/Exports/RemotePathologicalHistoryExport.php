<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\Models\RemotePathologicalHistory;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class RemotePathologicalHistoryExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RemotePathologicalHistory::select('remote_pathological_histories.*')
            ->join('patients', 'remote_pathological_histories.patient_id', '=', 'patients.id')
            ->where('patients.user_id', Auth::id())->get();
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
            'description',
            'note',
            'patient_id',
            'Created_At',
            'Updated_At',
        ];
    }
}
