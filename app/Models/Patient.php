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
        'occupation',
        'reservation',
    ];

    protected $casts = [
        'birthdate' => 'date', // Dopo aver recuperato la data dal db la converte in un oggetto carbon per il quale è possibile utilizzare il metodo format()
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class, 'patient_id');
    }

    public function physiologicalHistory()
    {
        return $this->hasMany(PhysiologicalHistory::class, 'patient_id');
    }
    
    public function familiarHistory()
    {
        return $this->hasMany(FamiliarHistory::class, 'patient_id');
    }

    public function remotePathologicalHistory()
    {
        return $this->hasMany(RemotePathologicalHistory::class, 'patient_id');
    }

    public function nextPathologicalHistory()
    {
        return $this->hasMany(NextPathologicalHistory::class, 'patient_id');
    }
}
