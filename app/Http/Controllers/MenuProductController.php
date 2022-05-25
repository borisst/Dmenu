<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuProductController extends Controller
{

    public function addProducts(Menu $menu)
    {

        return view('menus.add_products', [
            'products' => Product::all(),
            'menu' => Menu::whereId($menu->id)->firstOrFail()
        ]);

    }

    public function removeProducts(Menu $menu)
    {
        return view('menus.remove_products', [
            'menu' => $menu,
            'products' => $menu->products()->get()
        ]);
    }

    /**
     * Sends a single or array of IDs to attach
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function attachProducts(Menu $menu)
    {

        $products = request()->product;

        try {
            $menu->products()->attach($products);
            return redirect(route('menus-menu.show', $menu))->with('message', ['text' => 'Product(s) added!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus-menu.show', $menu))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

    /**
     *Sends a single or array of IDs to detach
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function detachSentences(Menu $menu)
    {

        $products = request()->product;

        try {
            $menu->products()->detach($products);
            return redirect(route('menus-menu.show', $menu))->with('message', ['text' => 'Product(s) removed!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus-menu.show', $menu))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

}
