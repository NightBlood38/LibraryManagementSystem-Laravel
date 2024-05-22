<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class memberController extends Controller
{
    public function index(Request $request)
    {
        $query = member::query();
        if ($request->filled('search_term')) {
            $filter = $request->input('filter');
            $searchTerm = '%' . $request->input('search_term') . '%';
            $query->where($filter, 'like', $searchTerm);
        }
        $members = $query->paginate(10);
        return view('members.index', compact('members'));
    }
    public function show($memberId)
    {
            $member = member::findOrFail($memberId);
        return view('members.show', compact('member'));
    }
    public function create()
    {
        return view('members.create');
    }
    public function edit(member  $member )
    {
        return view('members.edit', compact('member '));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nev' => 'required|string|max:30',
            'lakcim' => 'required|string|max:100',
            'tipus' => 'required|in:eh,eo,mp,mm',
            'emailcim' => 'required|email|unique:members,emailcim',
        ]);
        $member = member::create($validatedData);
        return redirect()->route('members.index')->with('success', 'Könyvtári tag sikeresen felvéve');
    }
    public function update(Request $request, member $member)
    {
        $validatedData = $request->validate([
            'nev' => 'required|string|max:30',
            'lakcim' => 'required|string|max:100',
            'tipus' => 'required|in:eh,eo,mp,mm',
            'emailcim' => 'required|email|unique:members,emailcim,' . $member->id,
        ]);
        $member->update($validatedData);
        return redirect()->route('members.index')->with('success', 'Könyvtári tag adatai sikeresen módosítva.');
    }
public function listLoans($memberId)
    {
        $member = member::findOrFail($memberId);
        $currentLoans = $member->loans()->whereNull('return_date')->get();
        $returnedLoans = $member->loans()->whereNotNull('return_date')->get();
        return view('members.loans', compact('member', 'currentLoans', 'returnedLoans'));
    }
}