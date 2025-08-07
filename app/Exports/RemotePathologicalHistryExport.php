<?php

namespace App\Exports;

use App\Models\RemotePathologicalHistory;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class RemotePathologicalHistryExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RemotePathologicalHistory::all();
    }
    public function getCsvSettings(): array
    {
        return [
            'use_bom' => true,
        ];
    }
}
