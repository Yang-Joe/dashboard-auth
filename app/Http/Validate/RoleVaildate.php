<?php
namespace App\Http\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleVaildate extends Controller
{

    protected function storeVaildate($request)
    {
        $this->validate($request, [
            'groupID' => 'required',
            'userID' => 'required',
            'isSuper' => 'required'
        ]);
    }

    protected function deleteVaildate($request)
    {
        $this->validate($request, [
            'roleID' => 'required',
            'userID' => 'required'
        ]);
    }

    protected function updateVaildate($request)
    {
        $this->validate($request, [
            'roleID' => 'required',
            'userID' => 'required',
            'isSuper' => 'required'
        ]);
    }
}
