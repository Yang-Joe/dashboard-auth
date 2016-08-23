<?php
namespace App\Http\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class GroupVaildate extends Controller
{

    protected function storeVaildate($request)
    {
        $this->validate($request, [
            'groupName' => 'required|max:255',
            'userID' => 'required'
        ]);

    }

    protected function updateVaildate($request)
    {
        $this->validate($request, [
            'groupName' => 'required|max:255',
            'groupID' => 'required',
            'userID' => 'required'
        ]);
    }

    protected function daleteVaildate($request)
    {
        $this->validate($request, [
            'groupID' => 'required',
            'userID' => 'required'
        ]);
    }
}
