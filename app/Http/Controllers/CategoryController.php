<?php
/**
 * Created by PhpStorm.
 * User: molde
 * Date: 07.08.2019
 * Time: 23:55
 */

namespace App\Http\Controllers;


use App\Models\Author;
use App\Models\CategoryName;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories() {
        return json_encode(CategoryName::all(), JSON_UNESCAPED_UNICODE);
    }

    public function setCategory(Request $request) {
        $categoryData = json_decode($request->getContent(), true);
        $newCategory = new CategoryName();

        $newCategory -> name = $categoryData['new_category'];
        $newCategory -> created_at = date('Y-m-d H:i:s');
        $newCategory -> updated_at = date('Y-m-d H:i:s');
        $newCategory -> save();
        return "Ok";
    }
}
