<?php

namespace App\Http\Controllers;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function index(){
        $menuItems = MenuItem::all();

        return view('menu', compact('menuItems'));
    }

    public function addMenu(){
        return view('addmenu');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        MenuItem::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('menu')->with('success', 'Menu item added successfully!');
    }
}
