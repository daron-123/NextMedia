<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name","parent_id",'created_at','updated_at',];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
