<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JWTAuth;

class Common extends Model
{
    use HasFactory;

    // get users which is not group member by group id

    public static function getUserNotGroupMember(){
        User::get();
    }

    public static function getFriendOrGroupById($message_against_id,$type){
        $user = JWTAuth::user();
        $data = [];
        // group query 
        if($type == 'group'){
            $data = Group::where('id',$message_against_id)
            ->whereHas('members',function($q)use($user){
                $q->where('user_id',$user->id);
            })
            ->first();
        }
        // end group 
        // friend query 
        else if($type == 'friend'){
            // geting friendship by id 
            $friendship = Friendship::where('id',$message_against_id)
            ->whereHas('friends',function($q)use($user){
                $q->where('user_id',$user->id);
            })->first();
            // end friendship
            // get friend by friendship id
            if($friendship){
                $friend = Friend::with('user')
                ->where('friendship_id',$friendship->id)
                ->first();
                $data = $friend->user;
            }
            // end friend
        }
        // end friend 
        return $data;
    }
}
