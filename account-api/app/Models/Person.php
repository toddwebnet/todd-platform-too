<?php

namespace App\Models;

class Person extends ActiveModel
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'phone'
    ];

    protected $hidden = ['is_active'];
}
