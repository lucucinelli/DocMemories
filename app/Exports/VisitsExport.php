<?php

namespace App\Exports;

use App\Models\Visit;
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
        return Visit::all();
    }
    public function getCsvSettings(): array
    {
        return [
            'use_bom' => true,
        ];
    }
}
