<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        return Item::orderBy('created_at', 'asc')->get();
    }
    public function show(Request $request, $id)
    {
        return Item::where('id','=',$id)->first();
    }
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item['name'];
        $newItem->save();

        return $newItem;
    }
    public function complete(Request $request, $id)
    {
        $existingItem = Item::find($id);
        $completed = $existingItem->completed;
        switch($completed){
            case(1):
                $opposite = 0;
                break;
            case(0):
                $opposite = 1;
                break;
        }

        if($existingItem){
            $existingItem->completed = $opposite;
            $existingItem->save();
            return $existingItem;
        }
        return "Item not found";

    }
    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);

        if($existingItem){
            $existingItem->name = $request->name;
            $existingItem->save();
            return $existingItem;

        }
        return "Item not found";
    }
    public function destroy($id)
    {
        $existingItem = Item::find($id);
        if($existingItem){
            $existingItem->delete();
            return "Item deleted";
        }
        return "Item not found";
    }
}
