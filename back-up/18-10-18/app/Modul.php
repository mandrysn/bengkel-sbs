<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Permission;

class Modul extends Model
{
    public function Permission()
    {
        return $this->hasMany('Permission');
    }
}
