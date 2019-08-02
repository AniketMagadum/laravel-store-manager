<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Store extends Model
{
    use RevisionableTrait;

    protected $revisionCreationsEnabled = true;

    protected $fillable = ['name','description','category_id','address','is_published'];

    public function category()
    {
        return $this->belongsTo('App\StoreCategory');
    }
}
