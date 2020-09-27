<?php

namespace App\Models;

class App extends ActiveModel
{
    protected $fillable = [
        'app_code',
        'app_name',
        'app_descr'
    ];
    protected $hidden = ['is_active'];

}
