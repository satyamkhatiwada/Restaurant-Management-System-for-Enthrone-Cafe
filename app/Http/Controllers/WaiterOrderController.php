<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Table;
use App\Models\WaiterOrder;

class WaiterOrderController extends Controller
{
    public function index(){
        $menuItems = MenuItem::all();
        $categories = Category::all();
        $tables = Table::all();
        $waiterOrders = WaiterOrder::all();
        // Pass menu items to the view
        return view('waiter.order', compact('menuItems','categories','tables','waiterOrders'));
    }

    public function makeOrder($id){
        $menuItems = MenuItem::all();
        $categories = Category::all();
        $table = Table::find($id);

        return view('waiter.makeorder', compact('menuItems','categories','table'));
    }

    public function updateWaiterOrderStatus(Request $request, $id){
        $request->validate([
            'status' => 'required|in:confirmed,completed',
        ]);
        
        $order = WaiterOrder::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function updateWaiterOrderStatusByWaiter(Request $request, $id){
        $request->validate([
            'status' => 'required|in:confirmed,completed',
        ]);

        $order = WaiterOrder::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
        
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function createOrder(Request $request, $id){
        $totalAmount = $request->input('total_amount');
        $items = json_decode($request->input('items'), true);
    
        $request->validate([
            'items' => 'required',
            'total_amount' => 'required|numeric',
        ]);  
    
        $order = WaiterOrder::create([
            'waiter_id' => Auth::id(),
            'table_id' => $id,
            'items' => json_encode($items),
            'total_amount' => $totalAmount,
            'status' => 'confirmed', // Assuming you want to set the status to 'confirmed' by default
        ]);    
    
        return redirect()->route('waiter.order')->with('success', 'Order placed successfully!');
    }
    
    
}
