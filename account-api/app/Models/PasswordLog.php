<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordLog extends Model
{
    protected $fillable = ['user_id', 'password'];
}
