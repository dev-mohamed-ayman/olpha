<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function sendMessage($receiver, Request $request)
    {
        $receiver = User::findOrFail($receiver);
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
