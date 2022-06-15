<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function index()
    {
        return view('promotions.index',[
           'promotions' => Promotion::all()
        ]);
    }
    public function welcome(Company $company){
        return view('promotions.welcome',[
           'promotions' => Promotion::all(),
           'company' => $company
        ]);
    }

    public function create()
    {
        return view('promotions.create',[
            'companies' => Company::owned()->get()
        ]);
    }

    public function store()
    {
        try {
            $promotion = Promotion::create([
                'company_id' => request('company_id'),
                'event_id' => request('event_id'),
                'name' => request('name'),
                'image' => ImageController::getImage(),
                'price' => request('price'),
                'date' => request('date')
            ]);
            $promotion->save();
            return redirect()->back()->with('success','Promotion added successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Please try again');
        }

    }


    public function show(Promotion $promotion)
    {
        return view('promotions.show',[
            'promotion' => $promotion,
        ]);
    }

    public function edit(Promotion $promotion)
    {

        return view('promotions.edit',[
            'promotion' => $promotion,
            'companies' => Company::owned()->get()
        ]);
    }


    public function update(Promotion $promotion)
    {
        try {
            $promotion->update([
                'company_id' => request('company_id'),
                'event_id' => request('event_id'),
                'name' => request('name'),
                'image' => ImageController::getImage(),
                'price' => request('price'),
                'date' => request('date')
            ]);
            return redirect()->back()->with('success','Promotion updated successfully');
        }catch(\Exception $e){
            return redirect()->back()->with('error','Please try again');
        }
    }


    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->back()->with('message','Promotion deleted');

    }
}
