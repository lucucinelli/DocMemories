<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    //
    protected $fillable = [
        'visit_date',
        'reason',
        'diagnosis',
        'reservation',
        'note',
        'user_id',
        'patient_id',
    ];

    protected $casts = [
        'visit_date' => 'date', // Convert visit_date to a Carbon instance
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function medicinals()
    {
        return $this->hasMany(Medicinal::class, 'visit_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'visit_id');
    }

    public function allergyTests()
    {
        return $this->hasMany(AllergyTest::class, 'visit_id');
    }
}
