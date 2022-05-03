<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }


    public function store(StoreProductRequest $request)
    {
        $product = Product::create([
            'name' => request('name'),
            'price' => request('price'),
            'category' => request('category'),
            'weight' => request('weight'),
            'description' => request('description'),
            'image' => request('image')
        ]);
        $product->save();
        return redirect()->back();
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


    public function update(StoreProductRequest $request, Product $product)
    {
        $product->update([
            'name' => request('name'),
            'price' => request('price'),
            'category' => request('category'),
            'weight' => request('weight'),
            'description' => request('description'),
            'image' => request('image')
        ]);
        $product->save();
        return redirect()->back();
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
