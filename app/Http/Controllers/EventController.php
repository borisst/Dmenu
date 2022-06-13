<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        return view('welcome', [
            'events' => Event::all()
        ]);
    }


    public function create()
    {
       return view('events.create',[
           'events' => Event::owned()->get()
       ]);
    }


    public function store(Request $request)
    {
        try {
            $event = Event::create([
                'name' => request('name'),
                'image' => ImageController::getImage(),
                'date' => request('date')
            ]);
            $event->save();
            return redirect()->back()->with(['success' => 'Event inserted successfully']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => 'Please try again']);
        }
    }


    public function show(Event $event)
    {
        return view('events.show',[
           'event' => $event
        ]);
    }

    public function edit()
    {
        return view('products.edit', [
            'event' => Event::owned()->first()
        ]);
    }


    public function update(Event $event)
    {
        try {
            $event->update([
                'name' => request('name'),
                'image' => ImageController::getImage(),
                'date' => request('date')
            ]);
            return redirect()->back()->with(['success' , 'Event successfully updated']);
        }catch(\Exception $e){
            return redirect()->back()->with(['error', 'Please try again']);
        }
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with(['message', 'Event deleted']);
    }
}
