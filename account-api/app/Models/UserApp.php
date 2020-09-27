<?php

namespace App\Models;

use App\Model\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
use HasCompositePrimaryKey;
protected $primaryKey = ['user_id', 'app_id'];
protected $fillable = ['user_id', 'app_id'];
}
