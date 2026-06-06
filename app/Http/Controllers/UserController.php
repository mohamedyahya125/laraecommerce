<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\Order;
use Illuminate\Support\Facades\Redirect;
use Session;
use Stripe;

class UserController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }
        $products = Product::latest()->take(2)->get();
        return view('index', compact('products', 'count'));
    }
    public function index()
    {
        if (Auth::check() && Auth::user()->user_type == "user") {
            return view('dashboard');
        } else if (Auth::check() && Auth::user()->user_type == "admin") {
            return view('admin.dashboard');
        }
    }
    public function productDetails($id)
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }
        $product = Product::findOrFail($id);
        return view('product_details', compact('product', 'count'));
    }
    public function allProducts()
    {
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
        } else {
            $count = '';
        }
        $products = Product::all();
        return view('allproducts', compact('products', 'count'));
    }
    public function addTOCart($id)
    {
        $products = Product::findOrFail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $products->id;
        $product_cart->save();
        return redirect()->back()->with('cart_message', 'added to the cart');
    }
    public function cartBroducts()
    {
        $cart = ProductCart::all();
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
            $cart = ProductCart::where('user_id', Auth::id())->get();
        } else {
            $count = '';
        }
        return view('viewcartproducts', compact('cart', 'count'));
    }
    public function removeCartProducts($id)
    {
        $cart_product = ProductCart::findOrFail($id);
        $cart_product->delete();
        return redirect()->back();
    }
    public function confirmOrder(Request $request)
    {
        $cart_product_id = ProductCart::where('user_id', Auth::id())->get();
        $address = $request->receiver_address;
        $phone = $request->receiver_phone;
        foreach ($cart_product_id as $car_product) {
            $order = new Order();
            $order->receiver_address = $address;
            $order->receiver_phone = $phone;
            $order->user_id = Auth::id();
            $order->product_id = $car_product->product_id;
            $order->save();
        }
        $carts = ProductCart::where('user_id', Auth::id())->get();
        foreach ($carts as $cart) {
            $cart_id = ProductCart::find($cart->id);
            $cart_id->delete();
        }
        return redirect()->back()->with('confirm_order', 'Order Confirmed');
    }
    public function myorsers()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        return view('viewmyorders', compact('orders'));
    }
    public function stripe($price)
    {
        $cart = ProductCart::all();
        if (Auth::check()) {
            $count = ProductCart::where('user_id', Auth::id())->count();
            $cart = ProductCart::where('user_id', Auth::id())->get();
        } else {
            $count = '';
        }
        $price = $price;

        return view('stripe', compact('count', 'price'));
    }
    public function stripePost(Request $request)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Stripe\Charge::create([

            "amount" => 100 * 100,

            "currency" => "usd",

            "source" => $request->stripeToken,

            "description" => "Test payment from itsolutionstuff.com."

        ]);
        $cart_product_id = ProductCart::where('user_id', Auth::id())->get();
        $address = $request->receiver_address;
        $phone = $request->receiver_phone;
        foreach ($cart_product_id as $car_product) {
            $order = new Order();
            $order->receiver_address = $address;
            $order->receiver_phone = $phone;
            $order->user_id = Auth::id();
            $order->product_id = $car_product->product_id;
            $order->payment_status = "paid";
            $order->save();
        }
        $carts = ProductCart::where('user_id', Auth::id())->get();
        foreach ($carts as $cart) {
            $cart_id = ProductCart::find($cart->id);
            $cart_id->delete();
        }



        return Redirect()->back()->with('success', 'Payment successful!');



        return back();
    }
}
