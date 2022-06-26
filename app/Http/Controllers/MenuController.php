<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Menu;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    /**
     * Show all user-owned menus and companies
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('menus.index', [
            'menus' => Menu::owned()->productsCount()->with('company.city')->get()
        ]);
    }

    public function  showProducts(Menu $menu)
    {
        $company = $menu->company()->first();

        return view('menus.show-products', [
            'assignedProducts' => $menu->products()->orderByPivot('category_id')->get(),
            'unassignedProducts' => Product::whereDoesntHave('menus')->get(),
            'menu' => $menu,
            'company' => $company
        ]);
    }

    /**
     * Show specific menu
     * @param Menu $menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Company $company, Menu $menu)
    {
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
    public function store(Request $request, QrCodeController $qrCodeController)
    {
        if (!auth()->hasUser()) {
            abort(403, 'Forbidden');
        }

        $attributes = request()->validate([
            'name' => 'required',
            'company_id' => 'required'
        ]);

//        dd($attributes);

        try {
            Menu::create([
                'name' => request()->name,
                'company_id' => request()->company_id,
                'slug' => Str::slug(request()->name),
                'qrcode' => $qrCodeController->storeQrCode(),
                'logo' => $qrCodeController->storeQrCodeLogo()

                // TODO skips validation for now, need to fix
            ]);

            return redirect()->back()->with('message', ['text' => 'The menu has been created', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

    public function edit(Menu $menu)
    {
        $this->authorize('update', $menu);

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
        $this->authorize('update', $menu);

        $request->validate([
            'name' => '',
            'company_id' => ''
        ]);

        try {
            Menu::whereId($menu->id)
                ->update([
                    'name' => $request->name,
                    'company_id' => $request->company_id,
                    'slug' => Str::slug($request->name)
                ]);
            return redirect(route('menus'))->with('message', ['text' => 'Menu updated!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

    public function delete(Menu $menu)
    {
        $this->authorize('delete', $menu);

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
        $this->authorize('delete', $menu);

        try {
            $menu->delete();
            return redirect()->back()->with('message', ['text' => 'Menu removed!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('menus'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

}
