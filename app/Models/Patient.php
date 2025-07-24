<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
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
        'occupation'
        
    ];

    protected $casts = [
        'birthdate' => 'date', // Dopo aver recuperato la data dal db la converte in un oggetto carbon per il quale è possibile utilizzare il metodo format()
    ];
}
