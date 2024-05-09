<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {

        $messages = Message::query()
            ->where('sender', auth()->user()->id)
            ->orWhere('receiver', auth()->user()->id)
            ->orderBy('id', 'asc')
            ->get();

        $data = [];

        foreach ($messages as $message) {
            if ($message->receiver == $request->user_id || $message->sender == $request->user_id) {
                array_push($data, $message);
            } else {
                continue;
            }
        }

        $messages = $data;

        return returnData(true, $messages);

    }


    public function sendMessage(Request $request)
    {
        $receiver = User::findOrFail($request->user_id);
        $user = auth()->user();
        $message = new Message();
        $message->sender = $user->id;
        $message->receiver = $receiver->id;
        $message->message = $request->message;
        $message->save();

        event(new \App\Events\Message(
            $receiver->username,
            $message->message,
            $user->image
        ));

        return response()->json([
            'receiver' => $receiver,
            'user' => $user,
            'message' => $message,
            'image' => asset($user->image)
        ]);

    }
}
