<?php

namespace App\Exports;

use App\Models\Medicinal;
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
        return Medicinal::all();
    }
    public function getCsvSettings(): array
    {
        return [
            'use_bom' => true,
        ];
    }
}
