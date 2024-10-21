<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller{

    public function index() {
        $book_data = Book::all();

        return view('book.index', compact('book_data'));
    }

    public function store() {

    }
}