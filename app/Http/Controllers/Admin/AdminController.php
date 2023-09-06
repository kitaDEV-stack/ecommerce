<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $total_products = Product::all()->count();
        $total_users = User::all()->count();
        $total_orders = Order::all()->count();
        $orders = Order::all();
        $revenue = 0;
        foreach($orders as $order){
            
            $revenue += $order->price; 
        }

        $delivered = Order::where('delivery_status','=','Delivered')->get()->count();
        $processing = Order::where('delivery_status','=','processing')->get()->count();
        return view('backend.layouts.app',compact('total_products','total_users','total_orders','revenue','delivered','processing'));
    }
}
