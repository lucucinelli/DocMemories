<?php

namespace App\Exports;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class PatientsExport implements FromCollection, WithHeadings, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Patient::where('user_id', Auth::id())->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'surname',
            'birthdate',
            'gender',
            'birthplace',
            'tax_code',
            'marital_status',
            'nationality',
            'city',
            'province',
            'address',
            'street_number',
            'zip_code',
            'domicile_city',
            'domicile_province',
            'domicile_address',
            'domicile_street_number',
            'domicile_zip_code',
            'telephone',
            'email',
            'occupation',
            'created_at',
            'updated_at',
        ];
    }
    public function getCsvSettings(): array
    {
        return [
            'use_bom' => true,
        ];
    }
}
