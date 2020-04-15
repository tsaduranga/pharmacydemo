<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class CustomerController extends Controller
{



    public function index(){
        return view('customers.index');
    }


    public function storee(Request $request){

     $order=Order::create($this->validateRequest());
     $this->storeImage($order);



        //$order= Order::create($data);
    }


    public function validateRequest(){
        return tap(request()->validate([
            'name' => 'required|min:2',
             'phone' => 'required|numeric',
             'nic' => '',
             'address'=> 'min:5',
             'details' => '',
             'status' => 'required'
        ]), function(){
            if(request()->hasFile('image1')){
                request()->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5048'
                ]);
            }
        });
    }


    public Function storeImage($order){

        if(request()->has('image1')){
            $order->update([
                'image' => request()->image->store('uploads','public'),
            ]);
        }
    }


    public function store(Request $request){


        $data=request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|min:2',
             'phone' => 'required|numeric',
             'nic' => '',
             'address'=> 'min:5',
             'details' => '',
             'status' => 'required'
       ]);
       if ($files = $request->file('image')) {
           $destinationPath = 'public/image/'; // upload path
           $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
           $files->move($destinationPath, $profileImage);
           $insert['image'] = "$profileImage";

           $data['image'] =implode($insert);
        }



        $check = Order::create($data);
        return redirect('/customers')->with('status', 'Oder is Completed!');

    }




}
