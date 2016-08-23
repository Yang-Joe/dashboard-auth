<?php
namespace App\Http\Validate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ExampleVaildate extends Controller
{

    protected function exVaildate($request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
    }

}
