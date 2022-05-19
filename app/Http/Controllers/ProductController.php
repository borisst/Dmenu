<?php

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::owned()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }


    public function store(ProductRequest $request)
    {
        try {
            Product::create([
                'name' => request('name'),
                'weight' => request('weight'),
                'description' => request('description'),
                'image' => Product::getImage(),
                'user_id' => Auth::id()
            ]);
            return redirect()->back()->with(['success' => 'Product inserted successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Please try again']);
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        if (Auth::id() !== $product->user_id) {
            return abort(404);
        } else {
            $product = Product::owned()->first();
            return view('products.edit', compact('product'));
        }


    }

    public function update(Product $product)
    {
        try {
            $product->update([
                'name' => request('name'),
                'weight' => request('weight'),
                'description' => request('description'),
                'image' => Product::getImage()
            ]);


            return redirect()->back()->with(['success' => 'Product updated successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Please try again']);
        }

    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with(['success', 'Product deleted successfully']);
    }
}
