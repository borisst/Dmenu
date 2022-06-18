<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
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
            'companies' => Company::all()
        ]);
    }

    public function show(Company $company)
    {
        return view('companies.show', [
            'company' => $company,
            'menus' => $company->menus()->get()
        ]);
    }

    public function create()
    {
        return view('companies.create');
    }

    /**
     * Stores a new company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $user = auth()->user();

        $attributes = request()->validate([
            'name' => 'required'
        ]);

        try {
            $user->companies()->create([
                'name' => request()->name,
                'slug' => Str::slug(request()->name)
            ]);
            return redirect(route('companies-index'))->with('message', ['text' => 'Компанијата е успешно додадена', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('companies-index'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }

    }

    public function edit(Company $company)
    {
        $this->authorize('update', $company);

        return view('companies.update', [
            'company' => $company
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

        try {
            Company::whereId($company->id)
                ->whereOwner(Auth::id())
                ->update([
                    'name' => $attributes->name,
                    'slug' => Str::slug(request('name'))
                ]);
            return redirect(route('company-show', $company))->with('message', ['text' => 'Името е успешно променето!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('company-show', $company))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
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
     * @param Company $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        try {
            $company->delete();
            return redirect(route('companies-index'))->with('message', ['text' => 'Компанијата е успешно променета!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('companies-index'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }

    }
}
