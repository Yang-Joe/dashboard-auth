<?php
namespace App\Repositories;

use App\Entities\Group;
use App\Entities\Role;

class RoleRepository
{
    public function hasRole($groupID, $userID)
    {
        $hasRole = Role::where('group_id', $groupID)->where('user_id', $userID)->first();

        return ($hasRole) ? true : false;
    }

    public function createRole($groupID, $userID, $isSuper)
    {
        $databaseGroup = Role::create(['group_id' => $groupID, 'user_id' => $userID, 'is_super' => $isSuper]);
        return true;
    }

    public function listRole($groupID)
    {
        $listRole = Role::where('group_id', $groupID)->with('groups')->with('users')->get();
        return $listRole;
    }

    public function deleteRole($groupID)
    {
        $databaseRole = Role::where('group_id', $groupID)->delete();

        return ($databaseRole) ? true : false;
    }

    public function deleteOnlyRole($roleID)
    {
        $checkDeleteRole = Role::find($roleID)->delete();
        return $checkDeleteRole;
    }

    public function checkRole($roleID)
    {
        $checkRoleID = Role::find($roleID);
        return $checkRoleID;
    }

    public function updateRole($roleID, $isSuper)
    {
        $updateRole = Role::find($roleID)->update(['is_super' => $isSuper]);
        return $updateRole;
    }
}

?>
