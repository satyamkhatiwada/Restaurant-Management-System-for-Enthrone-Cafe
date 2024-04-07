<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\CartItem;
use App\Models\WaiterOrder;
use Illuminate\Support\Facades\DB;

// require '../vendor/autoload.php';
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;


class OrderController extends Controller
{
    public function index(){
        $orders = Order::paginate(8);
        return view('admin.order', compact('orders'));
    }

    public function indexwaiter(){
        $waiterOrders = WaiterOrder::with('table')->paginate(8);
        return view('admin.waiterorder', compact('waiterOrders'));
    }
    
    public function updateOrderStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:pending,canceled,confirmed,processing,dispatched,completed',
        ]);
        
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        
        return redirect()->back()->with('success', 'Status updated successfully');
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

    public function esewaCallback(Request $request) {
        $tid = uniqid();
        $totalAmount = $request->input('total_amount');
        $items = json_decode($request->input('items'), true);

        $order = Order::create([
            'user_id' => Auth::id(),
            'phone_number' => $request->input('phone_number'),
            'items' => json_encode($items),
            'delivery_address' => $request->input('delivery_address'),
            'landmark' => $request->input('landmark'),
            'total_amount' => $totalAmount,
            'tid'=> $tid,
            'payment_method' => "unverified",
        ]);  
    
        // Set success and failure callback URLs.
        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // Config for development.
        $config = new Config($successUrl, $failureUrl);

        // Initialize eSewa client.
        $esewa = new Client($config);

        // Process the payment callback
        $esewa->process($tid, ($totalAmount - 100), 0, 0, 100);

    }
    

    public function esewaSuccess(){
        $tid = $_GET['oid'];
        $ref_id = $_GET['refId'];
        $amount = $_GET['amt'];

        $order = Order::where('tid',$tid)->first();

        $update_paymentmethod = Order::find($order->id)->update([
            'payment_method' => "Paid via esewa",
        ]);

        if($update_paymentmethod){
            $user = Auth::user();
            $user->cartItems()->delete();
            return redirect()->route('home')->with('success', 'Order placed successfully!');
        }
    }

    public function esewaFailed()
    {
        $tid = $_GET['pid'];
        $order = Order::where('tid', $pid)->first();
        //dd($order);
        $update_status = Order::find($order->id)->update([
            'esewa_status' => 'failed',
        ]);
        if ($update_status) {
            //send mail,....
            return redirect()->route('home')->with('error', 'Payment failed!');

        }
    }

    public function history(){
        $orders = Order::where('user_id', auth()->id())->paginate(6);
        return view('history', compact('orders'));
    }    

}
