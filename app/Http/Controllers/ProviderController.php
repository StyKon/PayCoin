<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provider=Provider::orderBy('id','DESC')->paginate();
        return view('backend.provider.index')->with('providers',$provider);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys=Category::get();
        $childcategorys=ChildCategory::get();
        return view('backend.provider.create')->with('categories',$categorys)->with('childcategorys',$childcategorys);
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
            'companyname'=>'string|required',
            'firstname'=>'string|required',
            'lastname'=>'string|required',
            'phone1'=>'string|required',
            'phone2'=>'string|required',
            'adresse'=>'string|required',
            'email'=>'string|required',
            'logo'=>'string|required',
            'lat'=>'string|required',
            'long'=>'string|required',
            'cat_id'=>'nullable|exists:categories,id',
            'child_cat_id'=>'nullable|exists:child_categories,id',
        ]);
        $data=$request->all();
        $status=Provider::create($data);
        $status->childcategorys()->sync($request->child_cat_id);
        if($status){
            request()->session()->flash('success','Provider successfully created');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('provider.index');
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
        $provider=Provider::find($id);
        $categorys=Category::get();
        $childcategorys=ChildCategory::get();
        $child_cat_id=json_encode(DB::select('select child_cat_id from child_categories_providers where provider_id = ?', [$id]));
        if(!$provider){
            request()->session()->flash('error','Provider not found');
        }
        return view('backend.provider.edit')->with('provider',$provider)->with('categories',$categorys)->with('childcategorys',$childcategorys)->with('child_cat_id',$child_cat_id);
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
        $provider=Provider::find($id);
        $this->validate($request,[
            'companyname'=>'string|required',
            'firstname'=>'string|required',
            'lastname'=>'string|required',
            'phone1'=>'string|required',
            'phone2'=>'string|required',
            'adresse'=>'string|required',
            'email'=>'string|required',
            'logo'=>'string|required',
            'lat'=>'string|required',
            'long'=>'string|required',
            'cat_id'=>'nullable|exists:categories,id',
            'child_cat_id'=>'nullable|exists:child_categories,id',
        ]);
        $data=$request->all();

        $status=$provider->fill($data)->save();
        $provider->childcategorys()->sync($request->child_cat_id);
        if($status){
            request()->session()->flash('success','Provider successfully updated');
        }
        else{
            request()->session()->flash('error','Error, Please try again');
        }
        return redirect()->route('provider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provider=Provider::find($id);
        if($provider){
            $status=$provider->delete();
            if($status){
                request()->session()->flash('success','Provider successfully deleted');
            }
            else{
                request()->session()->flash('error','Error, Please try again');
            }
            return redirect()->route('provider.index');
        }
        else{
            request()->session()->flash('error','Provider not found');
            return redirect()->back();
        }
    }
}
