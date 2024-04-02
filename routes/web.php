<?php

use Illuminate\Support\Facades\Route;

// import models (book, member, Loan)
use App\Models\book;
use App\Models\member;
use App\Models\Loan;
use App\Models\librarian;
// homepage route: http://localhost:8000/
Route::get('/', function () {
    return view('welcome');
});
// get librarians data (http://localhost:8000/librarians)
Route::get('/test-librarians', function () {
    dd(Librarian::all());
    });
// get members data (http://localhost:8000/members)
Route::get('/test-members', function () {
    dd(member::all());
    });
// get books data (http://localhost:8000/books)
Route::get('/test-books', function () {
    dd(book::all());
    });
// get loans data (http://localhost:8000/loans)
Route::get('/test-loans', function () {
    dd(Loan::all());
    });
// data relationship test: get the first member's loans
Route::get('/test-first-members-loans', function () {
    dd(member::first()->loans);
});
// data relationship test: get the first book's loans
Route::get('/test-first-book-loans', function () {
        dd(book::first()->loans);
});
// data relationship test: get the member associated with the first loan
Route::get('/test-first-loan-member', function () {
    dd(loan::first()->member);
});
// data relationship test: get the book associated with the first loan
Route::get('/test-first-loan-book', function () {
    dd(loan::first()->book);
});
Route::get('/book', function () {
    return view('books');
});
Route::get('/author', function () {
    return view('authors');
});