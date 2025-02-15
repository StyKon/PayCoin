<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Support\Str;
class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childcategorys=ChildCategory::getAllChildCategory();
        return view('backend.childcategory.index')->with('childcategorys',$childcategorys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $parent_cats=Category::orderBy('title','ASC')->get();
        return view('backend.childcategory.create')->with('parent_cats',$parent_cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'photo'=>'string|nullable',
            'status'=>'required|in:active,inactive',
            'cat_id'=>'required',
        ]);
        $data= $request->all();
        $slug=Str::slug($request->title);
        $count=ChildCategory::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;
        // return $data;   
        $status=ChildCategory::create($data);
        if($status){
            request()->session()->flash('success','Child Category successfully added');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('childcategory.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $childcategory=ChildCategory::findOrFail($id);
        $parent_cats=Category::get();
        return view('backend.childcategory.edit')->with('childcategory',$childcategory)->with('parent_cats',$parent_cats);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $childcategory=ChildCategory::findOrFail($id);
         $this->validate($request,[
             'title'=>'string|required',
             'summary'=>'string|nullable',
             'photo'=>'string|nullable',
             'status'=>'required|in:active,inactive',
             'cat_id'=>'required',
         ]);
         $data= $request->all();
         $status=$childcategory->fill($data)->save();
         if($status){
             request()->session()->flash('success','Child Category successfully updated');
         }
         else{
             request()->session()->flash('error','Error occurred, Please try again!');
         }
         return redirect()->route('childcategory.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $childcategory=ChildCategory::findOrFail($id);
        // return $child_cat_id;
        $status=$childcategory->delete();
        
        if($status){
            request()->session()->flash('success','Child Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting childcategory');
        }
        return redirect()->route('childcategory.index');
    }
    public function getSmallByParent(Request $request){
        $childcategory=ChildCategory::findOrFail($request->id);
        $small_cat=ChildCategory::getSmallByParentID($request->id);
        if(count($small_cat)<=0){
            return response()->json(['status'=>false,'msg'=>'','data'=>null]);
        }
        else{
            return response()->json(['status'=>true,'msg'=>'','data'=>$small_cat]);
        }
    }
}
