<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $fillable =['title','slug','summary','photo','status','added_by','cat_id'];

    public function categorys (){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public static function getSmallByParentID($id){
        return SmallCategory::where('child_cat_id',$id)->orderBy('id','ASC')->pluck('title','id');
    }
    public function provider(){
        return $this->hasMany('App\Models\Provider','child_cat_id','id');
    }
    public function sub_products(){
        return $this->hasMany('App\Models\Product','child_cat_id','id')->where('status','active');
    }
    public static function getProductBySubCat($slug){
        // return $slug;
        return ChildCategory::with('sub_products')->where('slug',$slug)->first();
    }
    public static function getAllChildCategory(){
        return ChildCategory::orderBy('id','DESC')->paginate(10);
    }
    public function small_cat(){
        return $this->hasMany('App\Models\SmallCategory','child_cat_id','id')->where('status','active');
    }
}
