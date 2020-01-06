<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
     public $table = 'forums';

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function threads()
    {
        return $this->hasMany(Thread::class, 'forum_id', 'id');
    }
}
