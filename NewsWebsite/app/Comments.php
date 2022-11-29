<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable =[
        'comment','parent_id','status','user_id','post_id',
    ];
    public function Posts(){
        return $this ->belongsTo('App\Posts','post_id');
    }
    public function User(){
        return $this->belongsTo('App\User','user_id');
    }
    public function replies (){
        return $this->hasMany('App\Comments','parent_id');
    }
}