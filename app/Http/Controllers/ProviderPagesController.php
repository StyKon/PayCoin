<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\Order;

class ProviderPagesController extends Controller
{
    public function login(){
        return view('backend.providerback.login.login');
    }
    public function loginSubmit(Request $request){
        $data= $request->all();
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active','role'=>'provider'])){
            Session::put('provider',$data['email']);
            request()->session()->flash('success','Successfully login');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Invalid email and password pleas try again!');
            return redirect()->back();
        }
    }
    public function index(){
        return view('backend.providerback.index');
    }
    public function orders()
    {
        $orders=Order::orderBy('id','DESC')->paginate(10);
        return view('backend.providerback.order.index')->with('orders',$orders);
    }
}
