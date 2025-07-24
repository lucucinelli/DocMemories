<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemotePathologicalHistory extends Model
{
    protected $fillable = [
        'date',
        'type',
        'description',
        'note',
        'patient_id',
    ];

    // Define any relationships or additional methods if necessary
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
