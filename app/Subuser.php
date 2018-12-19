<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subuser extends Model
{
    protected $fillable = ['name','email','password','type'];
}
