<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Menu;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    /**
     * Show all user-owned menus and companies
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('menus.index', [
            'menus' => Menu::owned()->productsCount()->with('company:id,name')->get()
//
        ]);
    }

    /**
     * Show specific menu
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Menu $menu)
    {
        // check if auth user owns menu's company
        if (!$menu->company()->whereRelation('owner', 'owner', Auth::id())) {
            abort(403, 'Menu is off the menu. :)');
        }

        return view('menus.show', [
            'menu' => $menu,
            'products' => $menu->products()->withPivot('price')->get()

        ]);
    }

    public function create()
    {
        return view('menus.create', [
            'companies' => Company::owned()->get()
        ]);
    }

    /**
     * Stores a new Menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        if (!auth()->hasUser()) {
            abort(403, 'Forbidden');
        }
        $attributes = request()->validate([
            'name' => 'required',
            'company_id' => 'required'
        ]);

        try {
            $menu = Menu::create($attributes);
            return redirect(route('menus'))->with('message', ['text' => 'The menu has been created', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

    public function edit(Menu $menu)
    {
        if (!$menu->company()->whereRelation('owner', 'owner', Auth::id())) {
            abort(403, 'Choose another menu');
        }

        return view('menus.edit', [
            'menu' => $menu,
            'companies' => Company::owned()->get()

        ]);
    }

    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Menu $menu, Request $request)
    {
        if (!$menu->company()->whereRelation('owner', 'owner', Auth::id())) {
            abort(403, 'Choose another menu');
        }

        $request->validate([
            'name' => '',
            'company_id'
        ]);

//dd($request);
        try {
            $menu->update([
                'name' => $request->name,
                'company_id' => $request->company_id
            ]);
            return redirect(route('menus-menu.show', $menu))->with('message', ['text' => 'Menu updated!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus-menu.show', $menu))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

    public function delete(Menu $menu)
    {
        if (!$menu->company()->whereRelation('owner', 'owner', Auth::id())) {
            abort(403, 'Choose another menu');
        }

        return view('menus.delete', [
            'menu' => $menu
        ]);
    }

    /**
     * Soft deletes menu and related products but keeps relationship intact
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Menu $menu)
    {
        if (!$menu->company()->whereRelation('owner', 'owner', Auth::id())) {
            abort(403, 'Choose another menu');
        }

        try {
            $menu->delete();
            $menu->products()->delete();
            return redirect(route('menus'))->with('message', ['text' => 'Menu removed!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

}
