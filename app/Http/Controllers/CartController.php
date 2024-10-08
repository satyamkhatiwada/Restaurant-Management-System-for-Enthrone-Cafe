<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function addToCart(Request $request, $menuItemId){
    $user = auth()->user();

    // Validate that $menuItemId corresponds to an existing menu item
    $menuItem = MenuItem::findOrFail($menuItemId);

    $existingCartItem = CartItem::where(['user_id' => $user->id, 'menu_item_id' => $menuItemId])->first();

    if ($existingCartItem) {
        // Increment the quantity if the item already exists in the cart
        $existingCartItem->update([
            'quantity' => $existingCartItem->quantity + $request->input('quantity', 1)
        ]);
    } else {
        // Add a new item to the cart if it doesn't exist
        $cartItem = CartItem::create([
            'user_id' => $user->id,
            'menu_item_id' => $menuItemId,
            'quantity' => $request->input('quantity', 1)
        ]);
    }
    return redirect()->route('menu')->with('success', 'Item added to the cart successfully.');
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

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()->with('menuItem')->get();
        $tax=0;
        $delivery=100;
    
        // Calculate subtotal
        $subtotal = $cartItems->sum(function ($cartItem) {
            return $cartItem->menuItem->price * $cartItem->quantity;
        });

        $total_amount = $subtotal+$tax+$delivery;
        return view('order', compact('cartItems', 'total_amount', 'tax', 'delivery'));
    }
    
}
