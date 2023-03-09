<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    public $table="target_list";

    public function regole()
    {

        return $this->hasMany(Associazioni::class,'targetId','id');
    }

}
