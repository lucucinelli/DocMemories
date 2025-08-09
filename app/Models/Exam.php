<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'type',
        'result',
        'file',
        'note',
        'visit_id',
    ];

    protected $hidden = ['file'];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
