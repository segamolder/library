<?php
/**
 * Created by PhpStorm.
 * User: molde
 * Date: 09.08.2019
 * Time: 21:03
 */

namespace App\Http\Controllers;


use App\Models\Author;
use App\Models\BookCopy;
use App\Models\IssuedBook;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
   public function getUsers() {
       return json_encode(User::where('is_librarian', 0)->get(), JSON_UNESCAPED_UNICODE);
   }

   public function getStudents() {
       $result = [];
       foreach (Student::all() as $student) {
           $studentInfo = new \stdClass();
           $studentInfo->name = $student->name;
           $studentInfo->surname = $student->surname;
           $studentInfo->lastname = $student->lastname;
           $studentInfo->studentclass = $student->student_class;
           $books = IssuedBook::where("student_id", $student->id)->get();
           $result_books = [];
           foreach ($books as $book) {
               $bookInfo = BookCopy::where("id", $book->book_id) -> first();
               $result_book = new \stdClass();
               $result_book -> author = Author::where("id", $bookInfo -> author)->first() -> name;
               $result_book -> title = $bookInfo -> title;
               array_push($result_books, $result_book);
           }
           $studentInfo->books = $result_books;
           array_push($result, $studentInfo);
       }
       return json_encode($result, JSON_UNESCAPED_UNICODE);
   }

   public function setStudent(Request $request) {
       $studentData = json_decode($request->getContent(), true);
       $student = new Student();
       $student -> name = $studentData["name"];
       $student -> surname = $studentData["surname"];
       $student -> lastname = $studentData["lastname"];
       $student -> student_class = $studentData["class"];
       $student -> created_at = date('Y-m-d H:i:s');
       $student -> updated_at = date('Y-m-d H:i:s');
       $student -> user_id = $studentData["user"];
       $student -> save();
       return "Ok";
   }

   public function requestBook(Request $request) {
       $studentId = Student::where('user_id', Auth::user() -> id) -> first();
       $bookId = json_decode($request->getContent(), true);
       $issueBook = new IssuedBook();
       $issueBook -> student_id =  $studentId -> id;
       $issueBook -> book_id = $bookId["id"];
       $issueBook -> is_returned = false;
       $issueBook -> created_at = date('Y-m-d H:i:s');
       $issueBook -> updated_at = date('Y-m-d H:i:s');
       $issueBook -> is_requested = true;
       $issueBook -> on_hands = false;
       $issueBook -> save();
       return "Ok";
   }

   public function getRequestedBooks() {
       $studentId = Student::where('user_id', Auth::user() -> id) -> first();
       $issuedBooks = IssuedBook::where('student_id', $studentId -> id) -> get();
       $res_books = [];
       foreach ($issuedBooks as $iss_book) {
           $book = BookCopy::where("id", $iss_book->book_id)->first();
           $author = Author::where("id", $book -> author) -> first();
           $result = new \stdClass();
           $result->author = $author -> name;
           $result->title = $book -> title;
           $result->is_requested = $iss_book -> is_requested;
           $result->is_returned = $iss_book -> is_returned;
           $result->on_hands = $iss_book -> on_hands;
           array_push($res_books, $result);
       }
       return json_encode($res_books, JSON_UNESCAPED_UNICODE);
   }

   public function getAllRequestedBooks() {
       $issuedBooks = IssuedBook::where('is_returned', 0) -> get();
       $res_books = [];
       foreach ($issuedBooks as $iss_book) {
           $student = Student::where('id', $iss_book -> student_id) -> first();
           $book = BookCopy::where("id", $iss_book->book_id)->first();
           $author = Author::where("id", $book -> author) -> first();
           $result = new \stdClass();
           $result->author = $author -> name;
           $result->title = $book -> title;
           $result->is_requested = $iss_book -> is_requested;
           $result->on_hands = $iss_book -> on_hands;
           $result -> student_name = $student -> name;
           $result -> student_surname = $student -> surname;
           $result -> student_lastname = $student -> lastname;
           $result -> issued_id = $iss_book -> id;
           array_push($res_books, $result);
       }
       return json_encode($res_books, JSON_UNESCAPED_UNICODE);
   }

   public function giveOut(Request $request) {
       $issueData = json_decode($request->getContent(), true);
       $issue = IssuedBook::find($issueData["id"]);
       $issue -> is_requested = false;
       $issue -> on_hands = true;
       $issue -> save();
       return "Ok";
   }

   public function return_book(Request $request) {
       $issueData = json_decode($request->getContent(), true);
       $issue = IssuedBook::find($issueData["id"]);
       $issue -> on_hands = false;
       $issue -> is_returned = true;
       $issue -> save();
       return "Ok";
   }

   public function cancel_book(Request $request) {
       $issueData = json_decode($request->getContent(), true);
       IssuedBook::find($issueData["id"]) -> delete();
       return "Ok";
   }

   public function isStudent() {
       if(Auth::user()->is_librarian) {
           return "librarian";
       } else {
           if(isset(Student::where("user_id", Auth::user() -> id)->first() -> id)) {
               return "1";
           } else {
               return "0";
           }
       }
   }
}
