<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->room = auth()->user()->room;
        $message->content = $request->content;
        $message->user_id = auth()->user()->id;
        $message->save();
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function changeRoom(Request $request) {
        $room = "";
        $user_id = (int)$request->user_id;
        $room = $user_id > auth()->user()->id ? (string)auth()->user()->id . (string)$user_id : (string)$user_id . (string)auth()->user()->id;
        $messages = Message::where('room', '=', $room)->first();

        if($messages) {
            ///room have message

            ///save this room in user info
            $user = User::where('id', '=', auth()->user()->id)->first();
            $user->room = $room;
            $user->save();

            ///get message in this room
            $messages = Message::where('room', '=', $room)->get();
            return response()->json($messages);
        } else {
            ///room haven't message

            ///save this room in user info
            $user = User::where('id', '=', auth()->user()->id)->first();
            $user->room = $room;
            $user->save();
            return response()->json(200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
