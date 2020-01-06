<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
       public $table = 'posts';

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
