<?php

namespace App\Exports;

use App\Models\Medicinal;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class MedicinalExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Medicinal::select('medicinals.*')
            ->join('visits', 'medicinals.visit_id', '=', 'visits.id')
            ->where('visits.user_id', Auth::id())->get();
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
            'name',
            'quantity',
            'usage',
            'period',
            'visit_id',
            'Created_At',
            'Updated_At'
        ];
    }
}
