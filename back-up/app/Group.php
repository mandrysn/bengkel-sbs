<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;
use App\User;

class Group extends Model
{
    protected $guarded = [];

    public function Permission()
    {
        return $this->hasMany('Permission');
    }

    public function User()
    {
        return $this->hasMany('User');
    }
}
