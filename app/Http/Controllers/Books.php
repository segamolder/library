<?php
/**
 * Created by PhpStorm.
 * User: molde
 * Date: 06.08.2019
 * Time: 23:35
 */

namespace App\Http\Controllers;


use App\Models\Author;
use App\Models\BookCopy;
use App\Models\Category;
use App\Models\CategoryName;
use http\Env\Request;

class Books extends Controller
{
    private $shelves = 15;
    private $places = 10;

    public function getAllBooks() {
        $books = BookCopy::all();
        $books_result = [];
        foreach ($books as $book) {
            $book_result = new \stdClass();

            $book_result -> id = $book -> id;
            $book_result -> author = Author::where('id', $book -> id) -> get();
            $book_result -> title = $book -> title;
            $book_result -> category = $this->getCategory($book -> id);
            $book_result -> publishing_year = $book -> publishing_year;
            $book_result -> created_at = $book -> created_at;
            $book_result -> updated_at = $book -> updated_at;

            array_push($books_result, $book_result);
        }
        return json_encode($books_result, JSON_UNESCAPED_UNICODE);
    }

    private function  getCategory($id) {
        $ids = Category::where('book_id', $id)-> get();
        $names = [];
        foreach ($ids as $cid) {
             $categoryName = CategoryName::where('id', $cid -> book_id)->get();
             array_push($names, $categoryName);
        }
        return $names;
    }

    public function addCategory(Request $request) {
        $categoryData = json_decode($request->getContent(), true);
        $newCategory = new CategoryName();

        $newCategory -> name = $categoryData['name'];
        $newCategory -> created_at = date('Y-m-d H:i:s');
        $newCategory -> updated_at = date('Y-m-d H:i:s');
        try {
            $newCategory->save();
        } catch (\Exception $ex) {
            throw new Exception("Не удалось сохранить");
        }
        return "Ok";
    }
}
