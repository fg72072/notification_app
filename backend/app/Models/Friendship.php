<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    public function friends(){
        return $this->hasMany(Friend::class,'friendship_id','id');
    }
}
