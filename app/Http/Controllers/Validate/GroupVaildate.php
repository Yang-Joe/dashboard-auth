<?php
namespace App\Http\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class GroupVaildate extends Controller
{

    protected function indexVaildate($request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
    }

    protected function storeVaildate($request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

    }

    protected function updateVaildate($request)
    {
        $this->validate($request, [
            'account' => 'required|email|max:255',
            'password' => 'required',
            'birthday' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'code' => 'required'
        ]);
    }

    protected function daleteVaildate($request)
    {
        $this->validate($request, [
            'account' => 'required|email|max:255',
            'password' => 'required',
            'birthday' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'code' => 'required'
        ]);
    }
}
