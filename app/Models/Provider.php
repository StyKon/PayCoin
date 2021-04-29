<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable=['companyname','firstname','lastname','phone1','phone2','adresse','email','logo','lat','long'];


    public function products(){
        return $this->hasMany('App\Models\Product','provider_id','id');
    }

}
