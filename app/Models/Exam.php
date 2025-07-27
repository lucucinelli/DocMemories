<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'date',
        'type',
        'note',
        'result',
        'visit_id',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
