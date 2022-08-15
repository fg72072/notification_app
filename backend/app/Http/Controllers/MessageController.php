<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\ReadMessage;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->get();
        return view('messages.list', compact('messages'));
    }
    public function store(Request $req, $id)
    {
        $type_validation = ['group','friend'];
        $validate = Request()->validate([
            'type' => 'required|min:1|max:6|in:'.implode(",", $type_validation),
            'body' => 'required|min:1|max:3000',
        ]);
        Message::createMessage($id,Auth::user()->id,$req->body,$req->type == 'group' ? 2 : 1);
        return back()->with(['success' => 'Message has been sent successfully.']);
    }

    private function send_message($req)
    {
        $client = new Client;
        $response = $client->request('POST', 'https://onesignal.com/api/v1/notifications', [
        'body' => '{"included_segments":["Subscribed Users"],"contents":{"en":"English or Any Language Message","es":"Spanish Message","pt" : '.utf8_encode("test").'},"name":"INTERNAL_CAMPAIGN_NAME"}',
          'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Basic NTU0NWNkMDQtYmNkMy00NzNkLTk2NTMtYTFkYzNlMDA4NjUy',
            'Content-Type' => 'application/json',
          ],
        ]);
        
        echo $response->getBody();

        
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();
        return back();
    }

    public function show(Request $req, $id)
    {
        $id = (int) $id;
        // read messages 
        Message::readMessage($id,$req->type,Auth::user()->id);
        // end read messages 
        $messages = Message::with('user')
        ->where('message_against_id', $id)
        ->when($req->type == 'group', function ($q) {
            return $q->where('type', '2');
        })->when($req->type == 'friend', function ($q) {
            return $q->where('type', '1');
        })->get();
        return view('messages.msg', compact('messages'));
    }

    public function getUnreadMessage()
    {
        $messages = Message::getAllUnreadMessages();
        $new_total_notification = Message::getAllUnreadMessagesCount();
        return response()->json([
            'success' => true,
            'data' => $messages,
            'new_total' => $new_total_notification
        ]);
    }

    public function getNotification(Request $req)
    {
        $messages = Message::with('user', 'group')
            ->where('user_id', '!=', Auth::user()->id)
            ->orderBy('id', 'desc');
        if ($req->notifi_limit == 5) {
            $messages = $messages->limit(5);
        }
        $messages = $messages->get();
        $new_total_notification = Message::where([['user_id', '!=', Auth::user()->id], ['is_seen', '=', '0']])->count();
        return response()->json([
            'success' => true,
            'data' => $messages,
            'new_total' => $new_total_notification
        ]);
    }
   
}
