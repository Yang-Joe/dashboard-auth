<?php
namespace App\Http\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserVaildate extends Controller
{

    protected function storeVaildate($request)
    {
        $this->validate($request, [
            'account' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'name' => 'required|max:255'
        ]);

    }

    protected function updateVaildate($request)
    {
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'name' => 'required|max:255',
            'userID' => 'required'
        ]);
    }

    protected function daleteVaildate($request)
    {
        $this->validate($request, [
            'userID' => 'required',
        ]);
    }
}
