<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Stripe;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Product;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    public function index()
    {
        $products = Product::paginate(6);
        $comments = Comment::orderby('id','desc')->get();
        $replies = Reply::all();
        return view('home.userpage', compact('products','comments','replies'));
    }

    public function show(Product $product)
    {
        return view('home.products_detail', compact('product'));
    }

    public function add_cart(Request $request, Product $product)
    {
        if (Auth::id()) {
            $user = Auth::user();
            $cart = new Cart;

            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;

            $cart->product_title = $product->title;

            if ($product->discount_price != null) {

                $cart->price = $product->discount_price * $request->quantity;
            } else {

                $cart->price = $product->price * $request->quantity;
            }
            $cart->image = $product->image;
            $cart->product_id = $product->id;

            $cart->quantity = $request->quantity;
            $cart->save();

            Alert::success('success', 'Add to Cart Successfully.');

            return redirect()->route('show.product');
        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if (Auth::id()) {

            $id = Auth::user()->id;
            $carts = Cart::where('user_id', '=', $id)->get();

            return view('home.showcart', compact('carts'));
        } else {

            return redirect('login');
        }
    }

    public function cart_remove(Cart $cart)
    {

        $cart->delete();
        return redirect()->back()->with('success', 'Cart Removed Successfully.');
    }

    public function cash_order()
    {
        $user = Auth::user();
        $userid = $user->id;

        $datas = Cart::where('user_id', '=', $userid)->get();

        foreach ($datas as $data) {
            $order = new Order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->product_id;

            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';

            $order->save();

            $cart_id = $data->id;

            $cart = Cart::find($cart_id);

            $cart->delete();
        }

        return redirect()->back()->with('success', 'We have Received your Order.We will contact you soon.Thank you!');
    }

    public function stripe($totalprice)
    {
        return view('home.stripe', compact('totalprice'));
    }

    public function stripePost(Request $request)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        $customer = Stripe\Customer::create(array(

            "address" => [

                "line1" => "Virani Chowk",

                "postal_code" => "360001",

                "city" => "Rajkot",

                "state" => "GJ",

                "country" => "IN",

            ],

            "email" => "demo@gmail.com",

            "name" => "Hardik Savani",

            "source" => $request->stripeToken

        ));



        Stripe\Charge::create([

            "amount" => 100 * 100,

            "currency" => "usd",

            "customer" => $customer->id,

            "description" => "Test payment from itsolutionstuff.com.",

            "shipping" => [

                "name" => "Jenny Rosen",

                "address" => [

                    "line1" => "510 Townsend St",

                    "postal_code" => "98140",

                    "city" => "San Francisco",

                    "state" => "CA",

                    "country" => "US",

                ],

            ]

        ]);



        Session::flash('success', 'Payment successful!');



        return back();
    }

    public function show_order()
    {

        if (Auth::id()) {

            $user = Auth::user();

            $userid = $user->id;

            $orders = Order::where('user_id', '=', $userid)->get();

            return view('home.order', compact('orders'));

        } else {

            return redirect('login');

        }
    }

    public function show_product(){

        $products = Product::all();

        return view('home.all_products', compact('products'));

    }

    public function cancel_order(Order $order){

        $order ->delivery_status = 'Canceled the order';

        $order->save();

        return redirect()->back();

    }

    public function add_comment(Request $request){

        if(Auth::id()){

            $comments = new Comment;

            $comments->name = Auth::user()->name;

            $comments->user_id = Auth::user()->id;

            $comments->comment=$request->comment;

            $comments->save();

            return redirect()->back();

        }else{

            return redirect('login');

        }
    }

    public function add_reply(Request $request){

        if(Auth::id()){

            $replies = new Reply;

            $replies->name = Auth::user()->name;

            $replies->user_id = Auth::user()->id;

            $replies->comment_id = $request->commentId;

            $replies->reply = $request->reply;

            $replies->save();

            return redirect()->back();

        }else{

            return redirect('login');

        }

    }

    public function search_product(Request $request){

        $searchText = $request->search;

        $products = Product::where('title', 'LIKE', "%$searchText%")->orWhere('category', 'LIKE', "$searchText")->paginate(6);

        $comments = Comment::orderby('id','desc')->get();

        $replies = Reply::all();

        return view('home.userpage',compact('products','comments','replies'));
        
    }
}
