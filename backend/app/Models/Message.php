<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class Message extends Model
{
    // 1 = friendship
    // 2 = group 

    use HasFactory;
    use SoftDeletes;
    protected $appends = ['date_diff'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'message_against_id', 'id');
    }

    public function friendship()
    {
        return $this->belongsTo(Friendship::class, 'message_against_id', 'id');
    }
    
    public function friend()
    {
        return $this->hasMany(Friend::class, 'friendship_id', 'message_against_id')->where([['user_id','!=',JWTAuth::user()->id]]);

    }

    public function read_by()
    {
        return $this->hasOne(ReadMessage::class, 'message_id', 'id');
    }

    public function getDateDiffAttribute(){
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public static function getAllMessages(){
        $group_id = GroupMember::where('user_id',Auth::user()->id)->pluck('group_id');
        $friendship_id = Friend::where('user_id',Auth::user()->id)->pluck('friendship_id');
    
        $message1 = Message::with('user','read_by','group')->where([
            ['user_id','!=',Auth::user()->id],
            ['type','=','2']
        ])->whereIn('message_against_id',$group_id);
    
        $message2 = Message::with('user','read_by')->where([
            ['user_id','!=',Auth::user()->id],
            ['type','=','1']
        ])->whereIn('message_against_id',$friendship_id);

        $message = $message1->union($message2)->orderBy('id','desc')->get();
        
        return $message;
    }

    public static function getAllUnreadMessagesCount(){
        $friendship_id = Friend::where('user_id',Auth::user()->id)->pluck('friendship_id');
        $group_id = GroupMember::where('user_id',Auth::user()->id)->pluck('group_id');
        $read_messages = ReadMessage::where('user_id',Auth::user()->id)
        ->get()->pluck('message_id');
        $message1 = Message::with('user')->where([
            ['user_id','!=',Auth::user()->id],
            ['type','=','1'],
        ])->whereIn('message_against_id',$friendship_id)->whereNotIn('id',$read_messages);
    
        $message2 = Message::with('user')->where([
            ['user_id','!=',Auth::user()->id],
            ['type','=','2'],
        ])->whereIn('message_against_id',$group_id)->whereNotIn('id',$read_messages);
        $message = $message1->union($message2)->orderBy('id','desc')->count();
        return $message;
    }

    public static function getAllUnreadMessages(){
        $group_id = GroupMember::where('user_id',Auth::user()->id)->pluck('group_id');
        $friendship_id = Friend::where('user_id',Auth::user()->id)->pluck('friendship_id');
        $read_messages = ReadMessage::where('user_id',Auth::user()->id)
        ->get()->pluck('message_id');
    
        $message1 = Message::with('user','read_by','group')->where([
            ['user_id','!=',Auth::user()->id],
            ['type','=','2'],
        ])->whereIn('message_against_id',$group_id)->whereNotIn('id',$read_messages);
    
        $message2 = Message::with('user','read_by')->where([
            ['user_id','!=',Auth::user()->id],
            ['type','=','1'],
        ])->whereIn('message_against_id',$friendship_id)->whereNotIn('id',$read_messages);

        $message = $message1->union($message2)->orderBy('id','desc')->get();
        
        return $message;
    }

    public static function readMessage($message_against_id,$type,$user_id)
    {
        $read_messages = ReadMessage::where('user_id',$user_id)
        ->get()->pluck('message_id');
        $update_messages = Message::where(
            [
                ['user_id', '!=', $user_id],
            ]
        )->where('message_against_id', $message_against_id)
        ->when($type == 'group', function ($q) {
            return $q->where('type', '2');
        })->when($type == 'friend', function ($q) {
            return $q->where('type', '1');
        })->whereNotIn('id',$read_messages)->get();
        // read message 
        if(count($update_messages) >= 1){
            foreach($update_messages as $message){
                $read = new ReadMessage;
                $read->user_id = $user_id;
                $read->message_id = $message->id;
                $read->save();
            }
        }
    }

    public static function createMessage($message_against_id,$user_id,$body,$type,$is_muted = '0')
    {
        $message = new Message;
        $message->message_against_id = $message_against_id;
        $message->user_id = $user_id;
        $message->body = $body;
        $message->type = $type;
        $message->is_muted = $is_muted;
        return $message->save();
    }
}
