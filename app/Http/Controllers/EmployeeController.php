<?php

namespace App\Http\Controllers;
use App\Models\Waiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\WaiterOrder;

class EmployeeController extends Controller
{
    public function dashboard()
    {
        $waiterData = auth()->guard('waiter')->user(); // Retrieve authenticated waiter data
        $waiterId = $waiterData->id; // Get the ID of the logged-in waiter from $waiterData
        $totalOrders = WaiterOrder::where('waiter_id', $waiterId)->count();
        
        return view('waiter.home', compact('waiterData', 'totalOrders'));
    }
    
    public function index(){
        $waiters = Waiter::paginate(6);
        return view('admin.employee', compact('waiters'));
    }

    public function addWaiter(){
        return view('admin.waiter');
    }

    public function createWaiter(Request $request)
    {
        // Validate the request data
        $request->validate([
            'code' => 'required|unique:waiters,code',
            'password' => 'required|min:6',
            // Add other validation rules as needed
        ]);

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Create a new waiter instance
        $waiter = new Waiter();
        $waiter->code = $request->code;
        $waiter->password = $hashedPassword; // Store the hashed password
        // Add other waiter details here if needed

        // Save the waiter to the database
        $waiter->save();

        // Redirect back with success message
        return redirect()->route('employee')->with('success', 'Waiter created successfully.');
    }
}
