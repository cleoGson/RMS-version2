<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public $table = 'categories';

    public function forum()
    {
        return $this->hasMany(Forum::class, 'category_id', 'id');
    }
}
