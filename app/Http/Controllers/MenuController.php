<?php

namespace App\Http\Controllers;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MenuController extends Controller
{
    //
    public function index(){
        $menuItems = MenuItem::paginate(8);
        return view('admin.menu', compact('menuItems'));
    }

    public function addMenu(){
        $categories = Category::all();
        return view('admin.addmenu', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);    
        // dd($request->file('image'));    

    $imagePath = $request->file('image')->store('menu_images', 'public');

    $menuItem = MenuItem::create([
        'name' => $request->name,
        'category_id' => $request->category_id,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    return redirect()->route('admin.menu')->with('success', 'Menu item added successfully!');
    }

    public function updateStatus(Request $request, $id){
        $menuItem = MenuItem::findOrFail($id);

        if (!$menuItem) {
            return redirect()->back()->with('error', 'Menu item not found.');
        }

        $status = $request->input('status');
        $menuItem->status = $status;
        $menuItem->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }



    public function editMenu($id){
        $menuItem = MenuItem::find($id);
        $categories = Category::all();
        return view('admin.editmenu', ['menuItem' => $menuItem, 'categories' => $categories]);
    }
    
    public function updateMenu(Request $request, $id){
        $menuItem = MenuItem::find($id);

        // Validate and update the menu item
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $menuItem->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::disk('public')->delete($menuItem->image);
        
            // Store the new image correctly
            $imagePath = $request->file('image')->store('menu_images', 'public');
            if ($imagePath) {
                $menuItem->update(['image' => $imagePath]);
            }
        }
        

        return redirect()->route('admin.menu')->with('success', 'Menu item updated successfully');
    }

    public function deleteMenu($id){

        $menuItem = MenuItem::find($id);

        if (!$menuItem) {
            return redirect()->route('admin.menu')->with('error', 'Menu item not found.');
        }

        // Delete the image from storage
        Storage::disk('public')->delete($menuItem->image);

        // Delete the menu item from the database
        $menuItem->delete();

        return redirect()->route('admin.menu')->with('success', 'Menu item deleted successfully');
    }

    

}
