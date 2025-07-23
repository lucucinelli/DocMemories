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
        'nationality',
        'birthplace',
        'province',
        'address',
        'street_number',
        'zip_code',
        'tax_code',
        'telephone',
        'email',
        'occupation'
        
    ];

    protected $casts = [
        'birthdate' => 'date', // Dopo aver recuperato la data dal db la converte in un oggetto carbon per il quale è possibile utilizzare il metodo format()
    ];
}
