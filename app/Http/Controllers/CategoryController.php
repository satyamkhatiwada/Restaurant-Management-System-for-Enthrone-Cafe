<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function addCategory(){
        $category = Category::paginate(5);
        return view('admin.addCategory',compact('category'));
    }

    public function store(Request $request)
{
    $request->validate([
        'category' => 'required|string',
    ]);

    Category::create([
        'category' => $request->category,
    ]);

    return redirect()->route('addCategory')->with('success', 'Category added successfully!');
}

public function deleteCategory($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('addCategory')->with('error', 'Category not found.');
    }

    // Delete the category from the database
    $category->delete();

    return redirect()->route('addCategory')->with('success', 'Category deleted successfully');
}



}
