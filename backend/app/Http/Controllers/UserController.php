<?php

namespace App\Http\Controllers;

use App\Containers\CommonContainer;
use App\Http\Requests\UserRequest;
use App\Models\Friend;
use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $media;

    public function __construct(CommonContainer $media){
        return $this->media = $media;
    }
    
    public function index()
    {
        $users = User::get();
        return view('users.list',compact('users'));
    }

    public function create()
    {
        return view('users.add');
    }

    public function store(UserRequest $req)
    {
        $user = new User;
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('users');
            $image->move($path, $name);
            $user->image = $name;
        }
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->name);
        $user->is_admin = $req->role;
        $user->status = $req->status;
        $user->save();
        return back()->with(['success'=>'User has been created successfully.']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $friendship_id = Friend::where('user_id',$id)->pluck('friendship_id');
        $friendship = Friend::with('friendship')->where('user_id',Auth::user()->id)->whereIn('friendship_id',$friendship_id)->first();
        $friendship = $friendship ? $friendship->friendship : [];
        if(!$friendship && Auth::user()->id != $user->id){
            $new_friendship = new Friendship;
            $new_friendship->creater_id = Auth::user()->id;
            $new_friendship->save();
            $friendship = $new_friendship;
            Friend::store($new_friendship->id,Auth::user()->id,2);
            Friend::store($new_friendship->id,$id,2);
        }
        return view('users.edit',compact('user','friendship'));
    }

    public function update(Request $req, $id)
    {
        $user = User::find($id);
        if($req->name){
            $user->name = $req->name;
        }
        if($req->role){
            $user->is_admin = $req->role;
        }
        if($req->status){
            $user->status = $req->status;
        }
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $this->media->unlinkProfilePic($user->image,'users');
            $name  = $this->media->getFileName($image);
            $path  = $this->media->getProfilePicPath('users');
            $image->move($path, $name);
            $user->image = $name;
        }
        $user->save();
        return back()->with(['success'=>'User has been updated successfully.']);
    }

    public function changePassword(Request $req)
    {
        if (Hash::check($req->current_password, Auth::user()->password)) {
            $validate = Request()->validate([
                'current_password' => 'required|min:8|max:20',
                'password' => 'required|min:8|max:20|confirmed'
            ]);
            Auth::user()->update([
                'password'=> Hash::make($req->password),
            ]);
            return redirect()->back()->with(['success'=>'Your password has been changed']);
        } else {
            return redirect()->back()->with(['error'=>'The provided password does not match your current password.']);
        }
    }
}
