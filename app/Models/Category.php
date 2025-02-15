<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['title','slug','summary','photo','status','added_by'];

 /*   public function parent_info(){
        return $this->hasOne('App\Models\Category','id','parent_id');
    }*/
    public static function getAllCategory(){
        return  Category::orderBy('id','DESC')->paginate(10);
    }
    public static function getAllCategoryHelper(){
        return  Category::where('status','active')->orderBy('title','ASC')->get();
    }
/*
    public static function shiftChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }*/
    public static function getChildByParentID($id){
        return ChildCategory::where('cat_id',$id)->orderBy('id','ASC')->pluck('title','id');
    }
/*
    */public function child_cat(){
        return $this->hasMany('App\Models\ChildCategory','cat_id','id')->where('status','active');
    }
    public function providers(){
        return $this->belongsToMany( 'App\Models\Provider', 'categories_providers', 'cat_id', 'provider_id' );
    }
    public static function getAllParentWithChild(){
        return Category::with('child_cat')->where('status','active')->orderBy('title','ASC')->get();
    }
    public static function getAllChildBySlagCat($slug){
        return Category::with('child_cat')->where('slug',$slug)->where('status','active')->first();
    }

    public function products(){
        return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
    }
    public static function getProductByCat($slug){
        return Category::with('products')->where('slug',$slug)->first();
    }
    public static function countActiveCategory(){
        $data=Category::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }
}
