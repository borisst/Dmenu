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
            'companies' => Company::owned()->select('id', 'name')->get(),
            'menus' => Menu::owned()->with('products:id,name,category,weight,description,image')->get()
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
            'menu' => Menu::owned()->with('products:id,name,category,weight,description,image')->get()

        ]);
    }

    public function create(Company $company)
    {
        if (Auth::id() != $company->owner) {
            abort(403, 'Choose another company');
        }

        return view('menus.create', [
            'company' => $company,
            'products' => Product::owned()->get()
        ]);
    }

    /**
     * Stores a new Menu
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Company $company)
    {
        if (Auth::id() != $company->owner) {
            abort(403, 'Choose another company');
        }

        $products = request()->product;

        $name = request()->validate([
            'name' => 'required'
        ]);

        try {
            $company->products()->attach($products, ['name' => $name, 'user_id' => Auth::id()]);
            return redirect(route('companies-index'))->with('message', ['text' => 'The menu has been created', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('companies-index'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

    public function edit(Company $company)
    {
        if (Auth::id() != $company->owner) {
            abort(403, 'Choose another company');
        }

        return view('companies.update', [
            'company' => $company
        ]);
    }

    /**
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Company $company)
    {
        if (Auth::id() != $company->owner) {
            abort(403, 'Choose another company');
        }

        $menu = request()->validate([
            'name' => 'required'
        ]);

        try {
            $company->update($menu);
            return redirect(route('company-show', $company))->with('message', ['text' => 'Името е успешно променето!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('company-show', $company))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }

    }

    public function delete(Company $company)
    {
        return view('menus.delete', [
            'company' => $company
        ]);
    }

    /**
     * Soft delete menu
     * @param Company $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Company $company)
    {
        if (Auth::id() != $company->owner) {
            abort(403, 'Choose another company');
        }

        $menu = request()->validate([
            'name' => 'required'
        ]);

        try {
            $company->products()->wherePivot('name', $menu)->delete();
            return redirect(route('companies-index'))->with('message', ['text' => 'Menu removed!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('companies-index'))->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }

    }

}
