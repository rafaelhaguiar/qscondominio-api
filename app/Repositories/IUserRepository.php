<?php

namespace App\Repositories;
use Illuminate\Http\Request;

interface IUserRepository{
    public function registerUser(Request $request);
}