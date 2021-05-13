<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
class Product extends Model
{
    protected $fillable=['title','slug','summary','description','cat_id','child_cat_id','small_cat_id','price','brand_id','provider_id','discount','status','photo','size','stock','is_featured','condition'];

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function sub_cat_info(){
        return $this->hasOne('App\Models\ChildCategory','id','child_cat_id');
    }
    public function small_cat_info(){
        return $this->hasOne('App\Models\SmallCategory','id','small_cat_id');
    }

    public static function getAllProduct(){
        return Product::orderBy('id','desc')->paginate(10);
    }

    public function rel_prods(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->orderBy('id','DESC')->limit(8);
    }
    public function getReview(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->with('user_info')->where('status','active')->orderBy('id','DESC');
    }
    public static function getProductBySlug($slug){
        return Product::with(['cat_info','rel_prods','getReview'])->where('slug',$slug)->first();
    }
    public static function countActiveProduct(){
        $data=Product::where('status','active')->count();
        if($data){
            return $data;
        }
        return 0;
    }

    public function carts(){
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists(){
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }


    public static function getProductByChildCategoryAndProvider($sub_slug,$slug_provider){
        return Product::select('products.*')->leftJoin('child_categories', 'products.child_cat_id', '=', 'child_categories.id')
        ->where('child_categories.slug',$sub_slug)
        ->leftJoin('providers', 'products.provider_id', '=', 'providers.id')
        ->where('providers.slug',$slug_provider)->where('products.status','active')->get();
    }


    public static function getSmallCatByChildCategoryAndProvider($sub_slug,$slug_provider){
        return Product::select('small_categories.id')->leftJoin('child_categories', 'products.child_cat_id', '=', 'child_categories.id')
        ->where('child_categories.slug',$sub_slug)
        ->leftJoin('providers', 'products.provider_id', '=', 'providers.id')
        ->where('providers.slug',$slug_provider)->where('products.status','active')
        ->leftJoin('small_categories', 'products.small_cat_id', '=', 'small_categories.id')->groupBy('small_categories.id')->get()->toArray();
   }
}
