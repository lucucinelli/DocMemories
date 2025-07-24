<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllergyTest extends Model
{
    //
    protected $fillable = [
        'test_date',
        'test_type',
        'result',
        'note',
        'visit_id',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
