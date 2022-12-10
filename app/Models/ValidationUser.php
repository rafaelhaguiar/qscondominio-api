<?php

namespace App\Models;

class ValidationUser 
{
    const RULE_USER =      [
        'email' => 'required | max:30 | min:5',
        'name' => 'required | max:30'
    ];
}
