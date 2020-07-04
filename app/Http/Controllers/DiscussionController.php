<?php

namespace App\Http\Controllers;

use App\Discussion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;

class DiscussionController extends Controller
{
    public function discussions()
    {
        $user = auth()->guard('employee')->user();

        $employees = Employee::whereHas('department', function (Builder $query) use ($user) {
            $query->where('id', $user->department_id);
        })->where('id', '<>', $user->id)->get();
        return view('discussion.index', compact('employees'));
    }

    public function getMyDiscussions(Request $request)
    {
        $employee = auth()->guard('employee')->user();
        $page = $request->input('page');

        $discussions = $employee->getOpenDiscussions($page);
        $unreadDiscussionCount = $employee->countMyUnreadDiscussions();

        return response()->json([
            'unread_discussion_count' => $unreadDiscussionCount,
            'discussions' => $discussions
        ]);
    }

//    public function closeDiscussion(user $contact)
//    {
//        $user = auth()->user();
//
//        $discussionName = $user->id . '-' . $contact->id;
//        if ($user->id > $contact->id)
//            $discussionName = $contact->id . '-' . $user->id;
//        $discussion = Discussion::where('name', $discussionName)->first();
//        if (!$discussion) {
//            return response()->json(['status' => 'ok'], 200);
//        }
//        if ($discussion->users()->updateExistingPivot($user->id, ['closed' => 1])) {
//            return response()->json(['status' => 'ok'], 200);
//        } else {
//            return response()->json(['status' => 'error'], 500);
//        };
//
//    }

    public function getDiscussionMessages(Employee $contact, Request $request)
    {

        $user = auth()->guard('employee')->user();

        $discussionName = $user->id . '-' . $contact->id;
        if ($user->id > $contact->id)
            $discussionName = $contact->id . '-' . $user->id;

        $discussion = Discussion::where('name', $discussionName)->first();
        if (!$discussion) {
            //do not create discussion and add participants without a message
            /*$discussion = new Discussion();
            $discussion->name = $discussionName;
            $discussion->save();
            $discussion->users()->attach([$user->id,$contact->id]);*/

            return response()->json([], 200);
        }

        $discussion->messages()->where('receiver_id', '=', $user->id)->where('read', '=', 0)->update(['read' => 1]);
        $before = $request->input('before');
        $after = $request->input('after');

        $messages = $discussion->messages()->orderBy('created_at', 'DESC');
        if ($before) {
            $messages->where('id', '<', (int)$before)->limit(10);
        } elseif ($after) {
            $messages->where('created_at', '>', $after);
        } else {
            $messages->limit(10);
        }

        $messages = $messages->get();
        //return view('discussion.messages_contact',compact('messages','contact'));

        return response()->json($messages, 200);

    }

    public function saveMessage(Request $request)
    {
        $employee = auth()->guard('employee')->user();
        $sender_id = $employee->id;
        $receiver_id = (int)$request->input('receiver');
        $content = $request->input('content');
        $timestamp = time();
        $sent = 0;

        // 'sender':user_id, 'receiver':contact_id, 'content':message, 'timestamp':timestamp, 'sent':0 or 1
        //discussion name
        if ($sender_id == $receiver_id)
            die();

        $sender = $employee;
        $receiver = Employee::find($receiver_id);

        $discussionName = $sender->id . '-' . $receiver->id;
        if ($sender->id > $receiver->id)
            $discussionName = $receiver->id . '-' . $sender->id;

        //get discussion if it exists
        $discussion = Discussion::where('name', $discussionName)->first();
        if (!$discussion) {
            //create discussion and add participants
            $discussion = new Discussion();
            $discussion->name = $discussionName;
            $discussion->save();
            $discussion->users()->attach([$sender->id, $receiver->id]);
        } else {
            //if it's the second message from a non friend we did not answer to , just exit. disposable verification if handled well from mobile app. will enhance chat performance if removed
//            if (
//                $relation != 2
//                && ($discussion->messages()->where('sender_id', '=', $sender->id)->count() > 0
//                    && $discussion->messages()->where('sender_id', '=', $receiver->id)->count() == 0)
//            )
//                die();


            $discussion->users()->updateExistingPivot($sender->id, ['closed' => 0]);
            $discussion->users()->updateExistingPivot($receiver->id, ['closed' => 0]);
        }
        $message = $discussion->messages()->create([
            'content' => $content,
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'read' => $sent,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ]);
        $discussion->updated_at = time();
        $discussion->save();

        return 'success';
        //return view('discussion.index')->with('success');
    }

}
