<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class adminPanelController extends Controller
{
    //
    public function index(){
        $totalOrders = Order::count();
        $totalEarnings = Order::sum('total_amount');

        return view('admin.adminPanel', compact('totalOrders', 'totalEarnings'));
    }
}
