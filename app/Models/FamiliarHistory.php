<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamiliarHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'allergy',
        'relative',
        'note',
        'patient_id',
    ];

    // Define any relationships or additional methods if necessary
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
