<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('member', 'book')->paginate(10);
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::where('loanable', true)->get();
        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $member = Member::findOrFail($request->input('member_id'));
        $book = Book::findOrFail($request->input('book_id'));

        if (!$book->loanable) {
            return redirect()->back()->with('error', 'A kért könyv nem kölcsönözhető.');
        }

        $loan = new Loan();
        $loan->member_id = $request->input('member_id');
        $loan->book_id = $request->input('book_id');
        $loan->loan_date = Carbon::now();
        if ($loan->save()) {
            return redirect()->route('loans.index')->with('success', 'A könyv sikeresen kikölcsönözve.');
        } else {
            return redirect()->back()->with('error', 'Több könyv kikölcsönzése nem lehetséges.');
        }
    }
public function edit($id)
    {
        $loan = Loan::findOrFail($id);
        $members = Member::all();
        $books = Book::all();
        return view('loans.edit', compact('loan', 'members', 'books'));
    }

    public function update(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);

        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $loan->member_id = $request->input('member_id');
        $loan->book_id = $request->input('book_id');
        $loan->return_date = $loan->calculate_loan_deadline();
        $loan->save();

        return redirect()->route('loans.index')->with('success', 'Sikerült a kölcsönzés módosítása.');
    }

    public function destroy($id)
    {
        $loan = Loan::findOrFail($id);
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'A külcsönzés sikeresen törölve.');
    }

    public function returnBook($id)
    {
        $loan = Loan::findOrFail($id);
        $deadline = $loan->calculate_loan_deadline();
        $returnDate = Carbon::now();
        if ($returnDate->gt($deadline) ){
            $daysOverdue = $returnDate->diffInDays($deadline);
            $loan->return_date = $returnDate;
            $loan->save();
            return redirect()->back()->with('error', 'A könyvet ' . $daysOverdue . ' nap késéssel hozták vissza.');
        }
        $loan->return_date = $returnDate;
        $loan->save();
        return redirect()->back()->with('success', 'A könyvet a határidő túllépése előtt sikeresen visszahozták.');
    }
}