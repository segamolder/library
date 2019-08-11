<?php
/**
 * Created by PhpStorm.
 * User: molde
 * Date: 07.08.2019
 * Time: 19:58
 */

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function getAuthors() {
        return json_encode(Author::all(), JSON_UNESCAPED_UNICODE);
    }

    public function setAuthor(Request $request) {
        $authorData = json_decode($request->getContent(), true);
        $newAuthor = new Author();

        $newAuthor -> name = $authorData['new_author'];
        $newAuthor -> created_at = date('Y-m-d H:i:s');
        $newAuthor -> updated_at = date('Y-m-d H:i:s');
        $newAuthor -> save();
        return "Ok";
    }

    public function deleteAuthor(Request $request) {
        $authorData = json_decode($request->getContent(), true);
        Author::find($authorData["id"]) -> delete();
        return "Ok";
    }
}
