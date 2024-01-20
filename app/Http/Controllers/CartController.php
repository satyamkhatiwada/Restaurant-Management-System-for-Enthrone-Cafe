<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $menuItemId)
    {
        $user = auth()->user();

        // Validate that $menuItemId corresponds to an existing menu item
        $menuItem = MenuItem::findOrFail($menuItemId);

        $cartItem = CartItem::updateOrCreate(
            ['user_id' => $user->id, 'menu_item_id' => $menuItemId],
            ['quantity' => $request->input('quantity', 1)]
        );

        // Add any additional logic here

        return redirect()->route('cart.view')->with('success', 'Item added to the cart.');
    }



    public function viewCart()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('menuItem')->get();

        return view('cart', compact('cartItems'));
    }


    public function removeFromCart($cartItemId)
    {
        $user = auth()->user();
        $cartItem = $user->cartItems()->find($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
            // Add any additional logic here
            return redirect()->back()->with('success', 'Item removed from the cart.');
        } else {
            return redirect()->back()->with('error', 'Item not found in the cart.');
        }
    }

    public function updateCart(Request $request, $cartItemId)
    {
        $user = auth()->user();
    
        // Validate that $cartItemId corresponds to an existing cart item
        $cartItem = CartItem::findOrFail($cartItemId);
    
        // Update the quantity based on the submitted form data
        $newQuantity = max(1, $request->input('quantity', 1));
        $cartItem->update(['quantity' => $newQuantity]);
    
        // Add any additional logic here
    
        return redirect()->back()->with('success', 'Cart updated successfully.');
    }


}
