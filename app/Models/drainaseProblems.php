<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class drainaseProblems extends Model
{
    use HasFactory;
    protected $fillable = ['problem', 'marker_id'];

    public function marker()
    {
        return $this->belongsTo(Marker::class, 'marker_id');
    }
    
}
