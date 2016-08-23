<?php

namespace App\Http\Controllers\Api;

use App\Http\Validate\GroupVaildate;
use Illuminate\Http\Request;

use App\Repositories\GroupRepository;
use App\Repositories\RoleRepository;

class GroupController extends GroupVaildate
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        GroupRepository $groups,
        RoleRepository $roles
    )
    {
        $this->groups = $groups;
        $this->roles = $roles;
    }

    public function index()
    {
        $group = $this->groups->listGroup();
        return response()->json(['group' => $group], 200);
    }

    public function store(Request $request)
    {
        $this->storeVaildate($request);
        $hasGroup = $this->groups->hasGroup($request->groupName);
        if ($hasGroup) {
            return response()->json(['message' => 'Group already exists'], 403);
        }
        $databaseGroupID = $this->groups->createGroup($request->groupName);
        $this->roles->createRole($databaseGroupID, $request->userID, '1');
        return response()->json(['message' => 'Success'], 200);
    }

    public function destory(Request $request)
    {
        $this->daleteVaildate($request);
        $isSuper = $this->groups->isSuper($request->groupID, $request->userID);
        if ($isSuper) {
            $checkDeleteGroup = $this->groups->deleteGroup($request->groupID);
            if ($checkDeleteGroup) {
                $this->roles->deleteRole($request->groupID);
                return response()->json(['message' => 'Success'], 200);
            }
        }
        return response()->json(['message' => 'Insufficient permissions'], 403);
    }

    public function update(Request $request)
    {
        $this->updateVaildate($request);
        $hasGroup = $this->groups->hasGroup($request->groupName);
        if ($hasGroup) {
            return response()->json(['message' => 'Group already exists'], 403);
        }
        $isSuper = $this->groups->isSuper($request->groupID, $request->userID);
        if ($isSuper) {
            $checkUpdateGroup = $this->groups->updateGroup($request->groupID, $request->groupName);
            if ($checkUpdateGroup) {
                return response()->json(['message' => 'Success'], 200);
            }
        }
        return response()->json(['message' => 'Insufficient permissions'], 403);
    }
}
