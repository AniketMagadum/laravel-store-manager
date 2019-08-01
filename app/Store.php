<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name','description','store_categories_id','address','is_published'];

    public function category()
    {
        return $this->belongsTo('App\StoreCategory');
    }
}
