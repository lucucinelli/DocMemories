<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NextPathologicalHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'type',
        'name',
        'cause',
        'effect',
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
