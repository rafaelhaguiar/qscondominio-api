<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tb_user';

    protected $fillable = [
        'email',
        'name'
    ];

    public $timestamps = false;


}
