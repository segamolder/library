<?php
/**
 * Created by PhpStorm.
 * User: molde
 * Date: 06.08.2019
 * Time: 21:32
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
class AccountController extends Controller
{
    public function index()
    {
        return view('librarian/libraryinfo');
    }
}
