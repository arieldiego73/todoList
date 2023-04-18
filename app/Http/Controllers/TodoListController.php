<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListItem;

class TodoListController extends Controller
{

    public function index() {
        return view('welcome')
            ->with('unfinishedItems', ListItem::where('is_complete', 0)->orderBy('updated_at', 'desc')->get())
            ->with('completedItems', ListItem::where('is_complete', 1)->orderBy('updated_at', 'desc')->get());
    }

    public function markComplete($id) {
        $completedItem = Listitem::find($id);
        $completedItem->is_complete = 1;
        $completedItem->save();

        return redirect('/');
    }

    public function deleteItem($id) {
        $completedItem = Listitem::find($id)->delete();
        
        return redirect('/');
    }

    public function markIncomplete($id) {
        $completedItem = Listitem::find($id);
        $completedItem->is_complete = 0;
        $completedItem->save();

        return redirect('/');
    }

    public function saveItem(Request $request) {
        // \Log::info(json_encode($request->all()));

        $newListItem = new ListItem;
        $newListItem->name = $request->listTitle;
        $newListItem->detail = $request->listDetail;
        $newListItem->is_complete = 0;
        $newListItem->save();

        return redirect('/');
    }
}
