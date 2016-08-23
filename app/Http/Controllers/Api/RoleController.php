<?php

namespace App\Http\Controllers\Api;

use App\Http\Validate\RoleVaildate;
use Illuminate\Http\Request;

use App\Repositories\GroupRepository;
use App\Repositories\RoleRepository;

class RoleController extends RoleVaildate
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

    public function index($groupID)
    {
        $role = $this->roles->listRole($groupID);
        return response()->json(['role' => $role], 200);
    }

    public function store(Request $request)
    {
        $this->storeVaildate($request);
        $hasGroup = $this->groups->useIDHasGroup($request->groupID);
        if (!$hasGroup) {
            return response()->json(['message' => 'Group does not exist'], 403);
        }
        $hasRole = $this->roles->hasRole($request->groupID, $request->userID);
        if ($hasRole) {
            return response()->json(['message' => 'Role already exist'], 403);
        }
        $this->roles->createRole($request->groupID, $request->userID, $request->isSuper);
        return response()->json(['message' => 'Success'], 200);
    }

    public function destroy(Request $request)
    {
        $this->deleteVaildate($request);
        $checkRole = $this->roles->checkRole($request->roleID);
        if (!$checkRole) {
            return response()->json(['message' => 'Role does not exist'], 403);
        }
        $isSuper = $this->groups->isSuper($checkRole['group_id'], $request->userID);
        if ($isSuper) {
            $checkDeleteRole = $this->roles->deleteOnlyRole($request->roleID);
            if ($checkDeleteRole) {
                return response()->json(['message' => 'Success'], 200);
            }
        }
        return response()->json(['message' => 'Insufficient permissions'], 403);
    }

    public function update(Request $request)
    {
        $this->updateVaildate($request);
        $checkRole = $this->roles->checkRole($request->roleID);
        if (!$checkRole) {
            return response()->json(['message' => 'Role does not exist'], 403);
        }
        $isSuper = $this->groups->isSuper($checkRole['group_id'], $request->userID);
        if ($isSuper) {
            $checkUpdateRole = $this->roles->updateRole($request->roleID, $request->isSuper);
            if ($checkUpdateRole) {
                return response()->json(['message' => 'Success'], 200);
            }
        }
        return response()->json(['message' => 'Insufficient permissions'], 403);
    }
}
