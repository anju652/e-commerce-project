<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;

use App\Models\User;

use App\Models\Cart;


use App\Models\Order;

use Stripe;
use Session;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('usertype','user')->count();

        $product = product::all()->count();

        $order = Order::all()->count();

        $delivered = Order::where('status','Delivered')->count();


        return view('admin.index',compact('user','product','order','delivered'));
    }

    public function Home()
    {

        $product = product::all();
        if(Auth::id())
        {
        $user=Auth::user();
         $userid=$user->id;
         $count=Cart::where('user_id',$userid)->count();
         }
         else
         {
            $count='';
         }
        return view('Home.index',compact('product','count'));
    }
    public function login_home()
    {
         $product = product::all();
          if(Auth::id())
        {
        $user=Auth::user();
         $userid=$user->id;
         $count=Cart::where('user_id',$userid)->count();
         }
         else
         {
            $count='';
         }
     
         return view('Home.index',compact('product','count'));

    }

    public function product_detailes($id)
    {
         $product = product::find(decrypt($id));
          if(Auth::user())
        {
        $user=Auth::user();
         $userid=$user->id;
         $count=Cart::where('user_id',$userid)->count();
         }
         else
         {
            $count='';
         }
         $user=Auth::user();
         $userid=$user->id;
         $count=Cart::where('user_id',$userid)->count();
        
         return view('Home.product_detailes',compact('product','count'));
    }

    public function add_cart($id)
    {
        $product_id=$id;

        $user= Auth::user();

        $user_id=$user->id;

        $data= new Cart;

        $data->user_id=$user_id;

        $data->product_id=$product_id;
        $data->save();

        toastr()->timeout(10000)->closeButton()->addSuccess('Product Added to the Cart Successfully..');

        return redirect()->back();
    }

    public function mycart()
    {
          
         if(Auth::user())
        {
        $user=Auth::user();
         $userid=$user->id;
         $count=Cart::where('user_id',$userid)->count();
         $cart=Cart::where('user_id',$userid)->get();
         }
         else
         {
            $count='';
         }

         return view('Home.mycart',compact('count','cart'));


    }
    public function delete_product_mycart($id)
    {
        $cart=Cart::find($id);

        $cart->delete();
         toastr()->timeout(10000)->closeButton()->addSuccess('Product Removed from the cart Successfully..');
        return redirect()->back();
    }
    public function confirm_order(Request $request)
    {
        $userid= Auth::user()->id;
        $cart= Cart::where('user_id',$userid)->get();
        foreach ($cart as $carts) 
        {
          $data= new Order();
          $data->name = $request->name;
          $data->address = $request->address;
          $data->phone = $request->phone;
          $data->user_id = $userid;
          $data->product_id = $carts->product_id;
          $data->save();
        }
        
        foreach ($cart as $carts)
        {
            $data=Cart::find($carts->id);
            $data->delete();
        }
        toastr()->timeout(10000)->closeButton()->addSuccess('Order placed Successfully..');

        return  redirect()->back();

    }

    public function myorders()
    {

      
        $user=Auth::user();
         $userid=$user->id;
         $count=Cart::where('user_id',$userid)->count();
          
        

          $order= Order::where('user_id',$userid)->get();

        return view('Home.myorders',compact('count','order'));
    }

    public function stripe($value)
    {
        return view('Home.stripe',compact('value'));
    }

    public function stripePost(Request $request,$value)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    

        Stripe\Charge::create ([

                "amount" => $value * 100,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Test payment from complete" 

        ]);

      
        $userid= Auth::user()->id;
        $cart= Cart::where('user_id',$userid)->get();
        foreach ($cart as $carts) 
        {
          $data= new Order();
          $data->name = Auth::user()->name;
          $data->address = Auth::user()->address;
          $data->phone = Auth::user()->phone;
          $data->user_id = $userid;
          $data->product_id = $carts->product_id;
          $data->payment_status='Paid';
          $data->save();
        }
        
        foreach ($cart as $carts)
        {
            $data=Cart::find($carts->id);
            $data->delete();
        }
        toastr()->timeout(10000)->closeButton()->addSuccess('Order placed Successfully..');

        return  redirect('mycart');


    }



}
