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
    public function createOrder(Request $request)
    {

        $totalAmount = $request->input('total_amount');

        $items = json_decode($request->input('items'), true);

        $orderID = 'ORD' . Str::random(10); // Adjust the length as needed

        $request->validate([
            'user_id' => 'required',
            'order_id' => 'required',
            'items' => 'required',
            'delivery_address' => 'required|string',
            'landmark' => 'required|string',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);  
       
        $order = Order::create([
            'user_id' => Auth::id(),
            'order_id' => $orderID,
            'items' => json_encode($items),
            'delivery_address' => $request->input('delivery_address'),
            'landmark' => $request->input('landmark'),
            'total_amount' => $totalAmount,
            'payment_method' => $request->input('payment_method'),
        ]);
            
        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}
