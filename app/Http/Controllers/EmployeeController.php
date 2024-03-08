<?php

namespace App\Http\Controllers;
use App\Models\Waiter;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index(){
        $waiter = Waiter::all();
        return view('admin.employee', compact('waiter'));
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

        // Create a new waiter instance
        $waiter = new Waiter();
        $waiter->code = $request->code;
        $waiter->password = $request->password; // Hash the password
        // Add other waiter details here if needed

        // Save the waiter to the database
        $waiter->save();

        // Redirect back with success message
        return redirect()->route('employee')->with('success', 'Waiter created successfully.');
    }
}
