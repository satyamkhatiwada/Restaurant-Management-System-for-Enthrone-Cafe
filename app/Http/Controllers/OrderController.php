<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    public function index(){
        $order = Order::all();
        return view('admin.order', compact('order'));
    }
    
    public function createOrder(Request $request){
     
        $totalAmount = $request->input('total_amount');
        $items = json_decode($request->input('items'), true);

        $request->validate([
            'phone_number'=>'required|numeric|digits:10',
            'items' => 'required',
            'delivery_address' => 'required|string',
            'landmark' => 'required|string',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);  

        $order = Order::create([
            'user_id' => Auth::id(),
            'phone_number' => $request->input('phone_number'),
            'items' => json_encode($items),
            'delivery_address' => $request->input('delivery_address'),
            'landmark' => $request->input('landmark'),
            'total_amount' => $totalAmount,
            'payment_method' => $request->input('payment_method'),
        ]);    
        
        $user = Auth::user();
        $user->cartItems()->delete();

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }

}
