<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all()->toArray();
        return array_reverse($category);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'p_category' => 'required',
        ]);

        $input = $request->all();
        

        Category::create($input);

        return response()->json(['success'=> 'Category created successfully']);

    }
}
