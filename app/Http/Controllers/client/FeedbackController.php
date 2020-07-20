<?php

namespace App\Http\Controllers\client;

use App\Feed;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Feedback::whereHas('client', function (Builder $query) {
            $query->whereHas('user', function (Builder $query) {
                $query->where('id', auth()->guard('client')->user()->user_id);
            });
        })->get();

        return view('client.project.show', compact('feedback'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            //'date_feedback' => 'required',
        ]);

        $feed = new Feedback();
        $feed->text_feedback = $request->input('body');
        $feed->client_id = auth()->guard('client')->user()->id;
        $project = Project::find($request->project_id);
        $project->feedBacks()->save($feed);
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }
}
