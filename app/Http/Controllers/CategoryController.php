<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(){
        $categories = Category::all();
        $categories_list = Category::with('recursiveChildren')->whereNull('parent_id')->get();
        return view("category-create",compact("categories","categories_list"));
    }
    public function store(Request $request){
        $data['name'] = $request->name;
        $data['parent_id'] = $request->parent_id ?? null;
        $category = Category::create($data);
        return redirect()->back();
    }
    public function fetchSubcategories(Request $request)
{
    $subcategories = Category::where('parent_id', $request->parent_id)->get();
    return response()->json(['subcategories' => $subcategories]);
}
}
