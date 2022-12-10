<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\IUserRepository;

use Illuminate\Http\Request;

    class UserRepositoryEloquent implements IUserRepository
    { 

        public function __construct(User $user)
        {
            $this->model = $user;
        }
        private $model;
        public function registerUser(Request $request)
        {
           return $this->model->create($request->all());

        }
    }
    