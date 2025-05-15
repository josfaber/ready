<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $totalBooksCount = Book::count();
    return view('welcome', ['totalBooksCount' => $totalBooksCount]);
});
