<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RemotePathologicalHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'type',
        'description',
        'note',
        'patient_id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Define any relationships or additional methods if necessary
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
