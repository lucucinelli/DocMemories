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
}
