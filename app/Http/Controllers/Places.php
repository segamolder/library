<?php
/**
 * Created by PhpStorm.
 * User: molde
 * Date: 07.08.2019
 * Time: 22:01
 */

namespace App\Http\Controllers;


use App\Models\Bookplace;

class Places extends Controller
{
    public function getFreePlace() {
        return Bookplace::where('is_busy', 0)->where('is_free', 1)->first();
    }
}
