<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    // public function index(){
       
    // }

    public function addCategory(){
        return view('admin.addCategory');
    }

    public function store(Request $request)
    {
    $request->validate([
        'category' => 'required|string',
    ]);

    Category::create([
        'category' => $request->category,
    ]);

    return redirect()->route('admin.menu')->with('success', 'Category added successfully!');
    }


}
