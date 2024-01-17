<?php

namespace App\Http\Controllers;
use App\Models\Category;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;

class UserMenuController extends Controller
{
    public function index(){
    // Check if the user is authenticated
    if (auth()->check()) {
        // Logic for authenticated users
    }

    // Retrieve menu items for all users
    $menuItems = MenuItem::all();
    $categories = Category::all();
    // Pass menu items to the view
    return view('menu', compact('menuItems','categories'));
}

}
