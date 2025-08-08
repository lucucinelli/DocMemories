<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AllergyTest extends Model
{
    use HasFactory;
    
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
