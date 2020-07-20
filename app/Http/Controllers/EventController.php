<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $events = Event::with('employee')->where('user_id', auth()->user()->id);
        return view('event.index', compact('events'));
    }


    public function create()
    {
        $events = Event::where('user_id', auth()->user()->id);
        $employees = Employee::whereHas('department', function (Builder $query) {
            $query->where('user_id', auth()->user()->id);
        });
        return view('event.create', compact('events','employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);
        $event = new Event();
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->color = $request->input('color');
        $event->save();

        return redirect()->route('event')->with('success');
    }

    public function show($id)
    {
       //
    }
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);
        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->description = $request->input('description');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->color = $request->input('color');
        $event->save();
        return redirect()->route('event')->with('success');

    }


    public function destroy(Request $request)
    {
//        $event = Event::where('id', $request->id)->delete();

    }

}
