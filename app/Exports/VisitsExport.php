<?php

namespace App\Exports;

use App\Models\Visit;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class VisitsExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Visit::where('user_id', Auth::id())->get();
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
            'visit_date',
            'reason',
            'diagnosis',
            'reservation',
            'note',
            'user_id',
            'patient_id',
            'Created_At',
            'Updated_At',
        ];
    }
}
