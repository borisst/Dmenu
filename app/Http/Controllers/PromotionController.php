<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Event;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function index()
    {
        return view('promotions.index', [
            'promotions' => Promotion::all()
        ]);
    }

    public function welcome(Company $company)
    {
        return view('promotions.welcome', [
            'promotions' => Promotion::all(),
            'company' => $company
        ]);
    }

    public function create()
    {
        return view('promotions.create', [
            'companies' => Company::owned()->get(),
            'events' => Event::owned()->with('company')->get()
        ]);
    }

    public function store()
    {
        $company = Company::find(request()->company_id);

        $attributes = request()->validate([
            'company_id' => 'required',
            'event_id' => 'nullable',
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable',
            'price' => 'nullable',
            'date' => 'nullable'
        ]);
        try {
            $company->promotions()->create($attributes);
            return redirect()->back()->with('success', 'Promotion added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Please try again');
        }
    }


    public function show(Promotion $promotion)
    {
        return view('promotions.show', [
            'promotion' => $promotion,
        ]);
    }

    public function edit(Promotion $promotion)
    {
        $this->authorize('update', $promotion);

        return view('promotions.edit', [
            'promotion' => $promotion,
            'companies' => Company::owned()->get(),
            'events' => Event::owned()->with('company')->get()

        ]);
    }


    public function update(Promotion $promotion)
    {
        $this->authorize('update', $promotion);

        $attributes = request()->validate([
            'company_id' => 'required',
            'event_id' => 'nullable',
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable',
            'price' => 'nullable',
            'date' => 'nullable'
        ]);

        try {
            $promotion->update([
                'company_id' => $attributes['company_id'],
                'event_id' => $attributes['event_id'],
                'name' => $attributes['name'],
                'description' => $attributes['description'],
                'image' => ImageController::getImage(),
                'price' => $attributes['price'],
                'date' => $attributes['date']
            ]);
            return redirect()->back()->with('success', 'Promotion updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Please try again');
        }
    }


    public function destroy(Promotion $promotion)
    {
//        $this->authorize('delete', $promotion);

        $promotion->delete();
        return redirect()->back()->with('message', 'Promotion deleted');
    }
}
