<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmallCategory extends Model
{
    protected $fillable =['title','slug','summary','photo','status','added_by','child_cat_id'];

    public function childcategorys (){
        return $this->hasOne('App\Models\ChildCategory','id','child_cat_id');
    }
    public static function getAllSmallCategory(){
        return SmallCategory::orderBy('id','DESC')->paginate(10);
    }
}
