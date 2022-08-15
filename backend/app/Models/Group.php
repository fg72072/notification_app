<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function members(){
        return $this->hasMany(GroupMember::class,'group_id','id')->where([['remove_at', '=', null],['left_at', '=', null]]);
    }

    public function messages(){
        return $this->hasMany(Message::class,'message_against_id','id')->where('type','2');
    }
}
