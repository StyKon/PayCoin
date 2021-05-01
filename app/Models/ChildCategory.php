<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable =['title','slug','summary','photo','status','added_by','cat_id'];

    public function categorys (){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
}
