<?php

namespace App\Http\Controllers\employee;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EventController extends Controller
{


    public function index()
    {
        $events=Event::whereHas('user', function (Builder $query) {
            $query->whereHas('departments', function (Builder $query) {
                $query->where('id', auth()->guard('employee')->user()->department_id);
            });
        })->get();
        return view('employee.event.index', compact('events'));

    }


}
