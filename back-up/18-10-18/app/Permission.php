<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Modul;
use App\Group;

class Permission extends Model
{
    protected $guarded = [];

    public function Modul()
    {
        return $this->belongsTo(Modul::class);
    }
    public function Group()
    {
        return $this->belongsTo(Group::class);
    }
}
