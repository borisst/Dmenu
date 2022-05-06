<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

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


    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => request('name'),
            'price' => request('price'),
            'category' => request('category'),
            'weight' => request('weight'),
            'description' => request('description'),
            'image' => Product::getImage()
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

    //TODO. When trying to update an image it fails and fills the column with NULL.
    //TODO  p.s. When creating works perfectly fine.

    public function update(ProductRequest $request, Product $product)
    {
        $product->update([
            'name' => request('name'),
            'price' => request('price'),
            'category' => request('category'),
            'weight' => request('weight'),
            'description' => request('description'),
            'image' => Product::getImage()
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
