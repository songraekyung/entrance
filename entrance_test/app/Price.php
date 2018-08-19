<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table='amounts';
    protected $fillable = ['id','amounts','price'];
}
