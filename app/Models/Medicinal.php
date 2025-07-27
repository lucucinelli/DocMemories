<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicinal extends Model
{
    //
    protected $fillable = [
        'name',
        'dosage',
        'usage',
        'period',
        'visit_id',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
