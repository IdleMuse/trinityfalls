<?php

namespace App\Http\Controllers;

use App\Inventoryitem;
use Illuminate\Http\Request;
use Auth;

class InventoryitemController extends Controller
{
    public function __construct(){
        $this->authorizeResource(Inventoryitem::class);
    }

    public function store(Request $request){
        $fields = $request->validate([
            "character_id" => 'required|integer|exists:characters,id',
            "name" => 'required|string',
            "quantity" => 'sometimes|integer|min:1'
        ]);

        $inventoryitem = Inventoryitem::create($fields);

        return redirect()->route('characters.show', $inventoryitem->character)->with('success', 'Inventory item added!');
    }

    public function update(Request $request, Inventoryitem $inventoryitem){
        $fields = $request->validate([
            "character_id" => 'sometimes|integer|exists:characters,id',
            "name" => 'sometimes|string',
            "quantity" => 'sometimes|integer|min:0'
        ]);

        if(!Auth::user()->is_admin){
            unset($fields['name']);
        } else {
            $inventoryitem->name = $fields['name'];
        }

        if(!empty($fields['character_id']) && !empty($fields['quantity'])){
            $quantity_to_transfer = min($inventoryitem->quantity, $fields['quantity']);
            $inventoryitem->quantity = $inventoryitem->quantity - $fields['quantity'];
            $transferred = Inventoryitem::create([
                "character_id" => $fields['character_id'],
                "name" => $inventoryitem->name,
                "quantity" => $quantity_to_transfer
            ]);
        } else {
            if(Auth::user()->is_admin){
                $inventoryitem->quantity = $fields['quantity'];
            }
        }

        $character = $inventoryitem->character;
        if($inventoryitem->quantity < 1){
            $inventoryitem->delete();
        } else {
            $inventoryitem->save();
        }

        return redirect()->route('characters.show', $character)->with('success', 'Inventory updated!');
    }

    public function destroy(Inventoryitem $inventoryitem){
        $inventoryitem->delete();
        return redirect()->route('characters.show', $character)->with('success', 'Inventory item destroyed.');
    }
}
