<?php

namespace App\Http\Controllers\Api;

use App\Http\Validate\UserVaildate;
use Illuminate\Http\Request;

use App\Repositories\UserRepository;

class AuthController extends UserVaildate
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function register(Request $request)
    {
        $this->storeVaildate($request);
        $user = $this->users->createUser($request->all());
        return response()->json(['user' => $user], 200);
    }

    public function destroy(Request $request)
    {
        $this->daleteVaildate($request);
        $user = $this->users->deleteUser($request->userID);
        return response()->json(['message' => 'success'], 200);
    }

    public function update(Request $request)
    {
        $this->updateVaildate($request);
        $user = $this->users->updateUser($request->all());
        return response()->json(['message' => 'success'], 200);
    }

    public function index($userID)
    {
        $user = $this->users->listUserRole($userID);
        return response()->json(['user' => $user], 200);
    }
}
