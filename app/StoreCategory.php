<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model
{
   public function stores()
    {
        return $this->hasMany('App\Store');
    }
}
