<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventAttendee;
use App\Events\EventInviteEvent;
use App\Helper\Reply;
use App\Http\Requests\Events\StoreEvent;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Event::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['id', 'title', 'start', 'end']);
            return Response::json($data);
        }
        return view('fullEvent');
    }


    public function create(Request $request)
    {
        $insertArr = ['title' => $request->title,
            'start' => $request->start,
            'end' => $request->end
        ];
        $event = Event::insert($insertArr);
        return Response::json($event);
    }

    public function store($request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->start = Carbon::createFromFormat($this->global->date_format, $request->start_date)->format('Y-m-d') . ' ' . Carbon::createFromFormat($this->global->time_format, $request->start)->format('H:i:s');
        $event->end = Carbon::createFromFormat($this->global->date_format, $request->end_date)->format('Y-m-d') . ' ' . Carbon::createFromFormat($this->global->time_format, $request->end)->format('H:i:s');
        $event->label_color = $request->label_color;
        $event->save();

        return redirect()->back()->with('success');
    }

    public function show($id)
    {
        $this->event = Event::findOrFail($id);
        return view('event.show', $this->data);
    }
    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $updateArr = ['title' => $request->title, 'start' => $request->start, 'end' => $request->end];
        $event = Event::where($where)->update($updateArr);

        return Response::json($event);
    }


    public function destroy(Request $request)
    {
        $event = Event::where('id', $request->id)->delete();

        return Response::json($event);
    }

}
