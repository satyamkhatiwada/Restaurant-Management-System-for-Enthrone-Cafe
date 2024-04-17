<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index(){
        $inventories = Inventory::paginate(8);
        return view('admin.inventory', compact('inventories'));
    }

    public function deleteInventory($id){
        $inventory = Inventory::find($id);

        if (!$inventory) {
            return redirect()->route('admin.inventory')->with('error', 'Menu item not found.');
        }

        $inventory->delete();

        return redirect()->route('admin.inventory')->with('success', 'Menu item deleted successfully');
    }

    public function addInventory(){
        return view('admin.addinventory');
    }

    public function editInventory($id){
        $inventory = Inventory::find($id);

        if (!$inventory) {
            return redirect()->route('admin.inventory')->with('error', 'Menu item not found.');
        }

        return view('admin.editInventory', compact('inventory'));
    }

    public function storeInventory(Request $request)
    {
        $request->validate([
            'item' => 'required|string',
            'unit' => 'required|numeric',
            'name' => 'required|string', 
            'phone' => 'required|string', 
        ]);    
        
        $inventory = Inventory::create([
            'item' => $request->item,
            'unit' => $request->unit,
            'vendorName' => $request->name, 
            'vendorPhone' => $request->phone, 
        ]);
    
        return redirect()->route('admin.inventory')->with('success', 'Menu item added successfully!');
    }

    public function updateInventory(Request $request, $id){
        $inventory = Inventory::find($id);

        if (!$inventory) {
            return redirect()->route('admin.inventory')->with('error', 'Menu item not found.');
        }

        $request->validate([
            'item' => 'required|string',
            'unit' => 'required|numeric',
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);   

        $inventory->update([
            'item' => $request->input('item'),
            'unit' => $request->input('unit'),
            'vendorName' => $request->input('name'),
            'vendorPhone' => $request->input('phone'),
        ]);

        return redirect()->route('admin.inventory')->with('success', 'Menu item updated successfully');
    }  
}
