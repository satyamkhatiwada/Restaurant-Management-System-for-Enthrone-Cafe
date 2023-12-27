<?php

namespace App\Http\Controllers;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

    public function editMenu($id){
        $menuItem = MenuItem::find($id);
        return view('editmenu', ['menuItem' => $menuItem]);
    }

    public function updateMenu(Request $request, $id){
        $menuItem = MenuItem::find($id);

        // Validate and update the menu item
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menuItem->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Add logic to upload and save the new image
            $imagePath = $request->file('image')->store('menu_images', 'public');
            $menuItem->update(['image' => $imagePath]);
        }

        return redirect()->route('menu')->with('success', 'Menu item updated successfully');
    }

    public function deleteMenu($id){

        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return redirect()->route('menu')->with('error', 'Menu item not found.');
        }

        // Delete the image from storage
        Storage::disk('public')->delete($menuItem->image);

        // Delete the menu item from the database
        $menuItem->delete();

        return redirect()->route('menu')->with('success', 'Menu item deleted successfully');
    }

}
