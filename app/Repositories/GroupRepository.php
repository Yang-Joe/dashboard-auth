<?php
namespace App\Repositories;

use App\Entities\Group;
use App\Entities\Role;

class GroupRepository
{
    public function hasGroup($groupName)
    {
        $hasGroup = Group::where('name', $groupName)->first();

        return ($hasGroup) ? true : false;
    }

    public function useIDHasGroup($groupID)
    {
        $hasGroup = Group::find($groupID);
        return ($hasGroup) ? true : false;
    }
    public function createGroup($groupName)
    {
        $databaseGroup = Group::create(['name' => $groupName]);
        return $databaseGroup['id'];
    }

    public function isSuper($groupID, $userID)
    {
        $isSuper = Role::where('group_id', $groupID)
                        ->where('user_id', $userID)
                        ->where('is_super', '1')
                        ->first();

        return ($isSuper) ? true : false;
    }

    public function deleteGroup($groupID)
    {
        $databaseGroup = Group::destroy($groupID);
        return ($databaseGroup) ? true : false;
    }

    public function listGroup()
    {
        $group = Group::all();
        return $group;
    }

    public function updateGroup($groupID, $groupName)
    {
        $group = Group::find($groupID)->update(['name' => $groupName]);
        return $group;
    }
}

?>
