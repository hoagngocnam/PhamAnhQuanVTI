<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable =[
        'name','parent_id','slug'
    ];
    public function Posts(){
        return $this->hasMany('App\Posts','categories_id');
    }
}