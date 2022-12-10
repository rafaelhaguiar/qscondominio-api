<?php

namespace App\Services;

use App\Models\ValidationUser;
use App\Repositories\IUserRepository;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserService 
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function registerUser(Request $request){
        $validator = Validator::make(
            $request->all(),
            rules: ValidationUser::RULE_USER
        );
        if ($validator->fails()) {
            return response()->json(['error' => 'VACILAO'], status: Response::HTTP_BAD_REQUEST);
        }
        try {
            $user = $this->userRepository->registerUser($request);
            return response()->json($user, status: Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'error'], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    
    //
}
