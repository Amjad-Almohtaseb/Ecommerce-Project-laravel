<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::get();
        return view('admin.subcategory.index', compact('subcategories'));
    }

// ----------------------------------------------------------------------------

    public function create()
    {
        return view('admin.subcategory.create');
    }

// ----------------------------------------------------------------------------

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:3',
            'category'=>'required', // <select name="category" ...>
        ]);
        $a = Subcategory::create([
            'name'=>$request->name,
            'category_id'=>$request->category // category_id : column name in db
            // category: <select name="category" ...>
        ]);
        notify()->success('SubCategory created successfully');
        // return redirect()->route('subcategory.index');
        return $a;
    }

// ----------------------------------------------------------------------------

    public function show($id)
    {
        //
    }

// ----------------------------------------------------------------------------

    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        return view('admin.subcategory.edit', compact('subcategory'));
    }

// ----------------------------------------------------------------------------

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|min:3',
            'category'=>'required',
        ]);
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->name;
        $subcategory->category_id = $request->category;
        $subcategory->save();

        notify()->success('SubCategory updated successfully');
        return redirect()->route('subcategory.index');
    }

// ----------------------------------------------------------------------------

    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);
        $subcategory->delete();
        notify()->success('SubCategory deleted successfully');
        return redirect()->route('subcategory.index');

    }
}