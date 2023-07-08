<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = ['komentar','user_id','post_raw_id'];

       public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

           public function post_raw()
    {
        return $this->belongsTo(Post_raw::class, 'post_raw_id');
    }


}
