<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table='users';
    protected $fillable = ['id','amounts','email','fullname', 'username', 'password'];
}
