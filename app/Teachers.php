<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $fillable = ['name', 'gender','mobile','address','department_id'];
}
