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
        $user = Auth::id();
        try {
            $product = Product::create([
                'name' => request('name'),
                'category' => request('category'),
                'weight' => request('weight'),
                'description' => request('description'),
                'user_id' => $user,
                'company_id' => $user,
                'image' => Product::getImage()
            ]);
            $product->save();
            return redirect()->back()->with(['success' => 'Product inserted successfully']);
        }
        catch (\Exception $e){
            return redirect()->back()->with(['error' => 'Please try again']);
            }

    }

    public function show(Product $product)
    {
//        $product = Product::fowned()->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
//        $product = Product::owned()->findOrFail($id);
        return view('products.edit', compact('product'));

    }

    public function update(ProductRequest $request, Product $product)
    {
        try{
        $product->update([
            'name' => request('name'),
            'category' => request('category'),
            'weight' => request('weight'),
            'description' => request('description'),
            'image' => Product::getImage()
        ]);

            $product->save();
            return redirect()->back()->with(['success' => 'Product updated successfully']);
        }
        catch(\Exception $e){
            return redirect()->back()->with(['error' => 'Please try again']);
        }

    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with(['success', 'Product deleted successfully']);
    }
}
