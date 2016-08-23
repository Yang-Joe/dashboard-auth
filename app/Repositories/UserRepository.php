<?php
namespace App\Repositories;

use Auth;
use App\User;
use App\Entities\Group;
use Illuminate\Support\Facades\Crypt;
use App\Entities\Role;

class UserRepository
{
    public function createUser($userData)
    {
        $userData['password'] = Crypt::encrypt($userData['password']);
        return User::create($userData);
    }

    public function deleteUser($userID)
    {
        $user = User::find($userID)->delete();
        return $user;
    }

    public function updateUser($userData)
    {
        $userData['password'] = Crypt::encrypt($userData['password']);
        $user = User::find($userData['userID'])->update(['name' => $userData['name'], 'password' => $userData['password']]);
        return $user;
    }

    public function listUserRole($userID)
    {
        $listRole = Role::where('user_id', $userID)->with('groups')->get();
        return $listRole;
    }
}

?>
