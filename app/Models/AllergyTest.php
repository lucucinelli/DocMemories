<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllergyTest extends Model
{
    //
    protected $fillable = [
        'test_date',
        'test_type',
        'test_result',
        'test_note',
        'visit_id',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
