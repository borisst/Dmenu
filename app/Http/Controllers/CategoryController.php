<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Company $company, Menu $menu)
    {
        return view('categories.index', [
            'company' => $company,
            'categories' => $menu->products()->get()->pluck('category')->unique()
        ]);
    }

    public function show(Company $company, Category $category)
    {
     return view('categories.show', [
         'products' => $category->products()
     ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    /**
     * Stores a new company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {

        $attributes = request()->validate([
            'name' => 'required'
        ]);

        try {
            Category::create([
                'name' => request()->name,
                'slug' => Str::slug(request()->name)
            ]);
            return redirect(route('companies-index'))->with('message', ['text' => 'Category added', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('companies-index'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }
}
