<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
        'name','user_id', 'email', 'password','phone','surname','role','company'
    ];
}
