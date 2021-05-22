<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\SmallCategory;
use Illuminate\Support\Str;
class SmallCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smallcategorys=SmallCategory::getAllSmallCategory();
        return view('backend.smallcategory.index')->with('smallcategorys',$smallcategorys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $child_cats=ChildCategory::orderBy('title','ASC')->get();
        return view('backend.smallcategory.create')->with('child_cats',$child_cats);
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
         'child_cat_id'=>'required',
     ]);
     $data= $request->all();
     $slug=Str::slug($request->title);
     $count=SmallCategory::where('slug',$slug)->count();
     if($count>0){
         $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
     }
     $data['slug']=$slug;
     // return $data;   
     $status=SmallCategory::create($data);
     if($status){
         request()->session()->flash('success','Small Category successfully added');
     }
     else{
         request()->session()->flash('error','Error occurred, Please try again!');
     }
     return redirect()->route('smallcategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $smallcategory=SmallCategory::findOrFail($id);
        $child_cats=ChildCategory::get();
        return view('backend.smallcategory.edit')->with('smallcategory',$smallcategory)->with('child_cats',$child_cats);
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
        $smallcategory=SmallCategory::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'summary'=>'string|nullable',
            'photo'=>'string|nullable',
            'status'=>'required|in:active,inactive',
            'child_cat_id'=>'required',
        ]);
        $data= $request->all();
        $status=$smallcategory->fill($data)->save();
        if($status){
            request()->session()->flash('success','Small Category successfully updated');
        }
        else{
            request()->session()->flash('error','Error occurred, Please try again!');
        }
        return redirect()->route('smallcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $smallcategory=SmallCategory::findOrFail($id);
        $status=$smallcategory->delete();
        
        if($status){
            request()->session()->flash('success','Small Category successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting smallcategory');
        }
        return redirect()->route('smallcategory.index');
    }
}
