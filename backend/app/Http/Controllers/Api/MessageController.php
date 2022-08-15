<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Friend;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\ReadMessage;
use JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class MessageController extends Controller
{
    public function index()
    {
        $message = Message::getAllMessages();
        $unread_count = Message::getAllUnreadMessagesCount();
        return response()->json([
            'success' => true,
            'messages' => $message,
            'unread_count' => $unread_count
        ]);
    }

    public function readMessage($id, Request $req)
    {
        $type_validation = ['group', 'friend'];
        $validate = Request()->validate([
            'type' => 'required|min:1|max:6|in:' . implode(",", $type_validation),
        ]);
        // read messages 
        Message::readMessage($id, $req->type, JWTAuth::user()->id);
        // end read messages 
        return response()->json([
            'success' => true,
            'message' => 'Message Read Successfully.'
        ]);
    }
}
