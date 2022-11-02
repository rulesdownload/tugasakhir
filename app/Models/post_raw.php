<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post_raw extends Model
{
    use HasFactory;
    protected $fillable = ['des_lok','city_id', 'district_id','des_mas','lat','lng','user_id','problem_id','tipe_id','status_id'];

       public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

       public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

      public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

       public function problem()
    {
        return $this->belongsTo(drainaseProblems::class, 'problem_id');
    }
        public function type()
    {
        return $this->belongsTo(drainaseTypes::class, 'tipe_id');
    }
       public function status()
    {
        return $this->belongsTo(status::class, 'status_id');
    }
}
