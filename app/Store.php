<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name','description','category_id','address','is_published'];

    public function category()
    {
        return $this->belongsTo('App\StoreCategory');
    }
}
