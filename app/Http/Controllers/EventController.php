<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\Promotion;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        return view('events.index', [
            'events' => Event::all()
        ]);
    }

    public function welcome(Company $company)
    {
        return view('events.welcome', [
            'events' => Event::all(),
            'company' => $company
        ]);
    }


    public function create()
    {
        return view('events.create', [
            'companies' => Company::owned()->get()
        ]);
    }


    public function store(EventRequest $request)
    {
        try {
            auth()->user()->events()->create($request->validated());
            return redirect()->back()->with(['success' => 'Event inserted successfully']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => 'Please try again']);
        }
    }


    public function show(Event $event)
    {
        return view('events.show', [
            'event' => $event
        ]);
    }

    public function showPromotions(Event $event)
    {
        return view('events.show-promotions', [
            'event' => $event,
            'assignedPromotions' => $event->promotions()->get(),
            'unassignedPromotions' => $event->promotions()->whereNull('event_id')->get(),
            'company' => $event->company()->first()
        ]);
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);

        return view('events.edit', [
            'event' => $event,
            'companies' => Company::owned()->get()
        ]);
    }

    public function addPromotion(Event $event, Promotion $promotion)
    {
        $this->authorize('update', $event);

        $attributes = request()->validate([
            'date' => 'required',
            'event_id' => 'required'
        ]);

        try {
            Promotion::findOrFail($promotion->id)->update([
                'date' => $attributes['date'],
                'event_id' => $attributes['event_id']
            ]);

            return redirect()->back()->with('success', 'Promotion added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Please try again');
        }
    }


    public function update(Event $event)
    {
        $this->authorize('update', $event);

        try {
            $event->update([
                'name' => request('name'),
                'image' => ImageController::getImage(),
                'date' => request('date')
            ]);
            return redirect()->back()->with(['success', 'Event successfully updated']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error', 'Please try again']);
        }
    }


    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
//        $event->promotions->each->delete();
        $event->delete();
        return redirect()->back()->with(['message', 'Event deleted']);
    }
}
