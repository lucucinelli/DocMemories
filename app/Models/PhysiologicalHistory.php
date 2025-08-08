<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhysiologicalHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'birth',
        'atopy',
        'nursing',
        'diet',
        'habits',
        'period',
        'period_regularity',
        'patient_id',
    ];

    // Define any relationships or additional methods if necessary
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
