<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicinal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'quantity',
        'usage',
        'period',
        'visit_id',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }
}
