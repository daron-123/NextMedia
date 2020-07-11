<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name","description","price","image",'created_at','updated_at',];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }


}
