<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all()->toArray();
        return array_reverse($products);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categories' => 'required'
        ]);

        $input = $request->all();
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = 'img/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
        }

        Products::create($input);

        return response()->json(['success'=> 'Products created successfully']);

    }

    public function edit($id)
    {
        $product = Products::find($id);
        return response()->json($product);
    }

    public function update($id, Request $request)
    {
        $product = Products::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'belongs' => 'required'
        ]);

        $input = $request->all();
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = 'img/';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
            unlink('img/'.$product->image);
        }
        
        $product->update($input);

        return response()->json(['success'=> 'Product update successfully']);
    }

    public function delete($id)
    {
        $product = Products::find($id);
        $product->delete();
        unlink('img/'.$product->image);
        return response()->json(['success'=> 'Product deleted successfully']);

    }
}
