<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
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
            $user->companies()->create($attributes);
            return redirect(route('UPDATE'))->with('message', ['text' => 'Компанијата е успешно додадена', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('UPDATE'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }

    }

    public function edit(Company $company)
    {
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
        $user = auth()->user();

        $attributes = request()->validate([
            'name' => 'required'
        ]);

        try {
            $company->update($attributes);
            return redirect(route('UPDATE'))->with('message', ['text' => 'Името е успешно променето!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('UPDATE'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }

    }

    public function delete(Company $company)
    {
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

        try {
            $company->delete();
            return redirect(route('UPDATE'))->with('message', ['text' => 'Компанијата е успешно променета!', 'type' => 'success']);
        } catch (\Exception $e) {
            return redirect(route('UPDATE'))->with('message', ['text' => 'Обидете се повторно!', 'type' => 'danger']);
        }

    }
}
