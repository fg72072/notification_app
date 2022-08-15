<?php

namespace App\Http\Controllers;

use App\Models\GroupMember;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
   
    public function store(Request $req){
       $auth = Auth::user();
        foreach($req->participant as $user){
            $user = explode(',',$user);
            $user_name = explode(',',$user[1]);
            $member = GroupMember::where([['user_id', '=', $user[0]],['group_id',$req->group_id]])->first();
            if(!$member){
                $member = new GroupMember;
            }
            $member->group_id = $req->group_id;
            $member->user_id = $user[0];
            $member->left_at = NULL;
            $member->remove_at = NULL;
            $member->remove_by_id = 0;
            $member->save();
            $body = "$auth->name added ".implode(', ',$user_name)." to this conversation";
            Message::createMessage($req->group_id,$auth->id,$body,2,'1');
        }

        return back()->with(['success'=>'Participant has been added successfully.']);
    }

    public function destroy($id){
        $auth = Auth::user();
        $member = GroupMember::with('user')->where('id',$id)->first();
        $member->remove_at = now();
        $member->remove_by_id = Auth::user()->id;
        $member->save();
        $body = "$auth->name has removed ".$member->user->name." from this conversation";
        Message::createMessage($member->group_id,$auth->id,$body,2,'1');
        return back();
    }
}
