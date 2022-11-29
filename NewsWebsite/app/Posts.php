<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable =[
        'title','content','view','users_id','categories_id','hot_flag','post_time','photo','slug'
    ];
    public function Categories(){
        return $this ->belongsTo('App\Categories','categories_id');
    }
    public function User(){
        return $this->belongsTo('App\User','users_id');
    }
    public function Comments(){
        return $this->hasMany('App\Comments','post_id')->whereNull('parent_id');;
    }
        
}