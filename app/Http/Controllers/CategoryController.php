<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function index()
    {
    $categories = Category::paginate(10);
    return view('pages.categories.index', compact('categories'));
    }

    public function create(){
        return view('pages.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gid,svg|max:2048',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id . '.' .
            $image->getClientOriginalExtension());
            $category->image = 'storage/categories/' .$category->id / '.'.
            $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('categories.index')->with('success','Category created successfully');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('pages.categories.edit', compact('category'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id. '.' .
            $image->getClientOriginalExtension()
            ) ;
            $category->image = 'storage/categories/' . $category->id . '.' .
            $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('categories.index')->with('success','category updated successfully');
    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'category deleted successfully');
    }

}
