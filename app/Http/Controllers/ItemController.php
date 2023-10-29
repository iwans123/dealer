<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.items.index', [
            "items" => Item::latest()->filter(request(['search']))->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.items.form', [
            "categories" => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name_item' => 'required|max:255',
            'path_number' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
        ]);

        Item::create($validate);

        return redirect()->route('item');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Item::find($id)->first();

        return view('pages.items.form', [
            'item' => $item,
            'categories' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name_item' => 'required|max:255',
            'path_number' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
        ]);

        Item::find($id)->update($validate);

        return redirect()->route('item');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Item::find($id)->delete();

        return redirect()->route('item');
    }
}
