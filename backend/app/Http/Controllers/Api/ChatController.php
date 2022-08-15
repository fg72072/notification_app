<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Common;
use App\Models\Friend;
use App\Models\Friendship;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\ReadMessage;
use JWTAuth;
use Illuminate\Http\Request;


class ChatController extends Controller
{
    public function index(Request $req)
    {
        $type_validation = ['group','friend'];
        $validate = Request()->validate([
            'type' => 'required|min:1|max:6|in:'.implode(",", $type_validation),
            'message_against_id' => 'required|integer',
        ]);
        // read messages 
        Message::readMessage($req->message_against_id, $req->type, JWTAuth::user()->id);
        // end read messages 
        $data = Common::getFriendOrGroupById($req->message_against_id, $req->type);
        if ($data) {
            $data->chats = Message::with('user','read_by')
                ->where('message_against_id', $req->message_against_id)
                ->when($req->type == 'group', function ($q) {
                    $q->where('type', '2');
                })->when($req->type == 'friend', function ($q) {
                    return $q->where('type', '1');
                })->get();

            return response()->json([
                'success' => true,
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Not found',
            ], 404);
        }
    }
    public function store($id,Request $req)
    {
        $type_validation = ['group','friend'];
        $validate = Request()->validate([
            'type' => 'required|min:1|max:6|in:'.implode(",", $type_validation),
            'body' => 'required|min:1|max:3000',
        ]);
        try {

         $data = Common::getFriendOrGroupById($id, $req->type);

            if($data){
                if(Message::createMessage($id,JWTAuth::user()->id,$req->body,$req->type == 'group' ? 2 : 1)){
                    return response()->json([
                        'success' => true,
                        'message' => 'Message send successfully.',
                    ], 200);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Not found',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something goes wrong.',
            ], 403);
        }
    }

    public function chatList(Request $req)
    {
        $group_id = GroupMember::where('user_id',JWTAuth::user()->id)->pluck('group_id');
        $friendship_id = Friend::where('user_id',JWTAuth::user()->id)->pluck('friendship_id');

        $message1 = Message::with('user','read_by','group')->where([
            // ['user_id','!=',JWTAuth::user()->id],
            ['type','=','2']
        ])->whereIn('message_against_id',$group_id)->orderBy('id','desc')->get();
    
        $message2 = Message::with('friend.user','read_by')->where([
            // ['user_id','!=',JWTAuth::user()->id],
            ['type','=','1']
        ])->whereIn('message_against_id',$friendship_id)->orderBy('id','desc')->get();

        $message = $message1->merge($message2)->unique('message_against_id');
        // $message = $message1->union($message2)->orderBy('id','desc')->get()->unique('message_against_id');

        return response()->json([
            'success' => true,
            'data' => $message,
        ], 200);
        
    }
}
