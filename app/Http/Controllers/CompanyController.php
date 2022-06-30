<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Event;
use App\Models\Menu;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CompanyController extends Controller
{

    //TODO add authorization
    /**
     * lists all companies
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('companies.index', [
            'companies' => Company::owned()->withCount('menus', 'promotions', 'events')->get()
        ]);
    }

    public function show(Company $company)
    {
        return view('companies.show', [
            'company' => $company,
            'menus' => $company->menus()->get()
        ]);
    }

    public function showMenus(Company $company)
    {
        $menus = Menu::owned()->with('categories')->where('company_id', $company->id)->productsCount()->get();

//        dd($company)
        return view('companies.show-menus', [
            'menus' => $menus,
            'company' => Company::whereId($company->id)->withCount('promotions', 'events')->first()
        ]);
    }

    public function showPromotions(Company $company)
    {

//        dd($company);
        return view('companies.show-promotions', [
            'assignedPromotions' => $company->promotions()->with('event')->get(),
            'unassignedPromotions' => Promotion::where('company_id', $company->id)->whereNull('event_id')->get(),
            'company' => $company
        ]);
    }

    public function showEvents(Company $company)
    {
        return view('companies.show-events', [
            'events' => $company->events()->promotionsCount()->get(),
            'company' => $company
        ]);
    }

    public function create()
    {
        return view('companies.create', [
            'cities' => City::all()
        ]);
    }

    /**
     * Stores a new company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $user = auth()->user();

        $attributes = request()->validate([
            'name' => 'required',
            'city_id' => 'required',
            'contact_number' => 'nullable',
            'opens_at' => 'nullable',
            'closes_at' => 'nullable',
            'fb_link' => 'nullable',
            'ig_link' => 'nullable'
        ]);

//        dd($attributes);

        try {
            $user->companies()->create($attributes);
            return redirect()->back()->with('message', ['text' => 'Company created!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }
    }

    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        return view('companies.update', [
            'company' => $company,
            'cities' => City::all()
        ]);
    }

    /**
     * Updates the name of the company
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Company $company)
    {
        $this->authorize('update', $company);

        $attributes = request()->validate([
            'name' => 'nullable',
            'city_id' => 'nullable',
            'contact_number' => 'nullable',
            'opens_at' => 'nullable',
            'closes_at' => 'nullable',
            'fb_link' => 'nullable',
            'ig_link' => 'nullable'
        ]);

        try {
            Company::whereId($company->id)
                ->whereOwner(Auth::id())
                ->update($attributes);
            return redirect()->back()->with('message', ['text' => 'Company updated!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('company-show', $company))->with(
                'message',
                ['text' => 'Try again!!', 'type' => 'danger']
            );
        }
    }

    public function delete(Company $company)
    {
        $this->authorize('delete', $company);

        return view('companies.destroy', [
            'company' => $company
        ]);
    }

    /**
     * Deletes the company
     * @param  Company  $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        try {
            $company->delete();
            return redirect()->back()->with('message', ['text' => 'Company deleted!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect()->back()->with('message', ['text' => 'Try again!', 'type' => 'danger']);
        }
    }
}
