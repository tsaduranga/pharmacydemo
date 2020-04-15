<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders=Order::all();
        return view('pharmacy.index',compact('orders'));

    }

    public function changeStatus($id){
        $order = Order::where('id', $id)->update(['status' => 1]);

        return redirect('/pharmacy');
    }



}
