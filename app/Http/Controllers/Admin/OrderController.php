<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Psy\VersionUpdater\Downloader;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return view('backend.orders.index',compact('orders'));
    }

  public function delivered(Order $order){

    $order->delivery_status = 'Delivered';

    $order->payment_status = 'Paid';

    $order->save();

    return redirect()->back();

  }

  public function print_pdf(Order $order){
    
    $pdf = FacadePdf::loadView('backend.layouts.pdf',compact('order'));

    return $pdf->download('order_details.pdf');

  }

  public function search_order(Request $request){

    $searchText = $request->search;
    $orders = Order::where('name','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();

    return view('backend.orders.index',compact('orders'));
  }
}
