<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use DB;
use Session;
class ProductController extends Controller
{
    // fetching all products data
    function index(){
        // return product::all();
        $products = Product::all();
        return view('product',['products'=>$products]);
    }
    // fetching data related to a particular id
    function details($id){
        $product = Product::find($id);
        return view('detail',['details'=>$product]);
    }
    // fetching product from the search button
    function search(Request $request){
        $search = $request->input('search');
        // return view('product',['search'=>$search]);
        $data = product::where('name','like','%'.$search.'%')->get();
        return view('search',['products' => $data]);
    }
    // add to cart functionality
    function cart(Request $req){
        // check if user is logged in
        if ($req->session()->has('user')) {
            $cart = new Cart;
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->cart;
            $cart->save();
            return redirect('/');
        }
        else{
            return redirect('/logins') ;
        }        
    }
    // show added items number in the cart
    static function CartNum(){
        if (session()->has('user')) {
            $user_id = Session::get('user')['id'];
            return Cart::where('user_id',$user_id)->count();
        }   
        else{
            return redirect('/logins');
        }
    }
    // show items in the cart
    function showItem(){
        $user_id = Session::get('user')['id'];
        $count = Cart::where('user_id',$user_id)->count();
        if (session()->has('user') && $count > 0) {
            $user_id = Session::get('user')['id'];
            $products = DB::table('cart')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id',$user_id)
            ->select('products.*','cart.id as cart_id')
            ->get();
            return view("cartlist",['products'=>$products]);
        }
        else{
            return redirect('/');
        }
    }
    // remove from the cart
    function remove($id){
        if (session()->has('user')) {
            Cart::destroy($id);
            return redirect('cartlist');
        }
        else{
            return redirect('/logins');
        }
    }
    // order now
    function ordernow(){
        if (session()->has('user')) {
            $user_id = Session::get('user')['id'];
            $total = DB::table('cart')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id',$user_id)
            ->select('products.*','cart.id as cart_id')
            ->sum('products.price');
            return view("ordernow",['total'=>$total]);
            // return $products;
        }
        else{
            return redirect('/logins');
        }
    }
    function orderplace(Request $req){
        if ($req->session()->has('user')) {
            $user_id = Session::get('user')['id'];
            $all_cart = Cart::where('user_id',$user_id)->get();
            foreach ($all_cart as $cart) {
                $order = new Order;
                $order->user_id = $cart['user_id'];
                $order->product_id = $cart['product_id'];
                $order->status = "pending";
                $order->payment_method = $req->payment;
                $order->payment_status = "pending";
                $order->address = $req->address;
                $order->Save();
                $all_cart = Cart::where('user_id',$user_id)->delete();
            }
            return redirect('/');
        }
        else{
            return redirect('/logins');
        }
    }
    
    // orders list
    function order_list(){
        if (session()->has('user')) {
            $user_id = Session::get('user')['id'];
             $order_list = DB::table('orders')
            ->join('products','orders.product_id','=','products.id')
            ->where('orders.user_id',$user_id)
            ->get();
            return view("orderlist",['products'=>$order_list]);
        }
        else{
            return redirect('/logins');
        }
    }
}
