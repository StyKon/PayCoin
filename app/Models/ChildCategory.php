<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable =['title','slug','summary','photo','status','added_by','cat_id'];

    public function categorys (){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public static function getAllChildCategory(){
        return ChildCategory::orderBy('id','DESC')->paginate(10);
    }
    public function small_cat(){
        return $this->hasMany('App\Models\SmallCategory','child_cat_id','id')->where('status','active');
    }
}
