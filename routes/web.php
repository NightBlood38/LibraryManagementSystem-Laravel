<?php

use Illuminate\Support\Facades\Route;

// import models (book, member, Loan)
use App\Models\book;
use App\Models\member;
use App\Models\Loan;
use App\Models\librarian;
use App\Http\Controllers\bookController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\LoanController;
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
// crud routes for book, member, loan
Route::resource('books', bookController::class);
Route::resource('members', memberController::class);
Route::resource('loans', LoanController::class);
// plus routes for member's loans, book return
Route::get('members/{id}/loans', [memberController::class, 'listLoans'])->name('members.loans');
Route::post('/loans/returnBook/{id}', [loanController::class, 'returnBook'])->name('loans.return_book');
Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/', function () {
    return redirect('/home');
});

// authenticated routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);
    Route::resource('loans', LoanController::class);
    Route::get('members/{id}/loans', [MemberController::class, 'listLoans'])->name('members.loans');
    Route::post('loans/returnBook/{id}', [LoanController::class, 'returnBook'])->name('loans.return_book');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [BookController::class, 'index'])->name('home');
});
//logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');