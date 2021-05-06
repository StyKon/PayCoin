<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable=['companyname','firstname','lastname','phone1','phone2','adresse','email','logo','lat','long','cat_id'];


    public function products(){
        return $this->hasMany('App\Models\Product','provider_id','id');
    }
    public function categorys(){
        return $this->hasOne('App\Models\Category','cat_id','id');
    }
    public function childcategorys(){
        return $this->belongsToMany( 'App\Models\ChildCategory', 'child_categories_providers', 'provider_id', 'child_cat_id' );
    }

}
