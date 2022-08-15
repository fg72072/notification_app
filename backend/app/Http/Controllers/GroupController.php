<?php

namespace App\Http\Controllers;

use App\Containers\CommonContainer;
use App\Http\Requests\Group;
use App\Models\Group as ModelsGroup;
use App\Models\GroupMember;
use App\Models\Message;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index(){
        $data['groups'] = ModelsGroup::withCount('members')->get();
        return view('groups.list',$data);
    }

    public function create(){
        $users = User::where('id', '!=',Auth::user()->id)->get();
        return view('groups.add',compact('users'));
    }

    public function store(Group $req){
        $auth = Auth::user();
        $group = new ModelsGroup;
        $group->creater_id = Auth::user()->id;
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('groups');
            $image->move($path, $name);
            $group->image = $name;
        }
        $group->slug = SlugService::createSlug(ModelsGroup::class, 'slug', $req->title);
        $group->title = $req->title;
        $group->description = $req->description;
        $group->save();
        $body = "$auth->name has created $group->title";
        Message::createMessage($group->id,Auth::user()->id,$body,2,'1');
        foreach($req->participant as $key => $user){
           
            // add all users to group 
            if($user == 'all'){
                $all_users = User::get();
             
                foreach($all_users as $i => $all){
                    $this->addParticipant($group->id,$all->id);
                    if($all->id == $auth->id) {
                        unset($all_users[$i]);
                    }
                }
                $body = "$auth->name added ".implode(', ',Arr::pluck($all_users, 'name'))." to this conversation";
                Message::createMessage($group->id,Auth::user()->id,$body,2,'1');

            }
            else{
                $user = explode(',',$user);
                $user_name = explode(',',$user[1]);
                if($key == 0){
                // add admin to group
                $body = "$auth->name added ".implode(', ',$user_name)." to this conversation";
                Message::createMessage($group->id,Auth::user()->id,$body,2,'1');
                $this->addParticipant($group->id,Auth::user()->id);
                }
                // add specific users to group 
                $this->addParticipant($group->id,$user[0]);
            }
          
        }

        return back()->with(['success'=>'Group has been created successfully.']);
    }

    public function edit($slug){
        $group = ModelsGroup::with('members.user')->where('slug',$slug)->first();
        // $member = GroupMember::with('user')->where([['remove_at', '=', ''],['left_at', '=', '']])->get();
        $users = DB::select("SELECT * FROM users WHERE id NOT IN (SELECT user_id FROM group_members WHERE group_id = ".$group->id." AND (remove_at IS NULL AND left_at IS NULL))");
        return view('groups.edit',compact('group','users'));
    }

    public function update($slug,group $req){
        $group = ModelsGroup::where('slug',$slug)->first();
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $this->media->unlinkProfilePic($group->image,'groups');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('groups');
            $image->move($path, $name);
            $group->image = $name;
        }
        $group->title = $req->title;
        $group->description = $req->description;
        $group->save();
        return back()->with(['success'=>'Group has been updated successfully.']);
    }

    public function destroy($slug){
        $group = ModelsGroup::where('slug',$slug)->first();
        GroupMember::where('group_id',$group->id)->delete();
        Message::where('message_against_id',$group->id)->delete();
        $group->delete();
        return back();
    }

    private function addParticipant($group_id,$user_id)
    {
        $member = new GroupMember;
        $member->group_id = $group_id;
        $member->user_id = $user_id;
        return $member->save();
    }


}
