<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable=['companyname','slug','firstname','lastname','phone1','phone2','adresse','email','status','logo','lat','long'];


    public function products(){
        return $this->hasMany('App\Models\Product','provider_id','id');
    }
    public function categorys(){
        return $this->belongsToMany( 'App\Models\Category', 'categories_providers', 'provider_id', 'cat_id' );
    }
    public function childcategorys(){
        return $this->belongsToMany( 'App\Models\ChildCategory', 'child_categories_providers', 'provider_id', 'child_cat_id' );
    }

}
