<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;

class bookController extends Controller
{
    public function index(Request $request)
    {
        $query = book::query();
        if ($request->filled('search_term')) {
            $filter = $request->input('filter');
            $searchTerm = '%' . $request->input('search_term') . '%';
$query->where($filter, 'like', $searchTerm);
        }
        $books = $query->paginate(10);
             return view('books.index', compact('books'));
    }
    public function create()
    {
        return view('books.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publishyear' => 'required|integer',
            'edition' => 'required|integer',
            'isbn' => 'required|string|unique:books|max:13',
            'loanable' => 'required|boolean',
        ]);
        $book = book::create($validated);
        return redirect()->route('books.index')->with('success', 'Könyv sikeresen hozzáadva a könyvtári nyilvántartáshoz.');
    }
    public function show(book $book)
    {
        return view('books.show', compact('book'));
    }
    public function edit(book $book)
    {
        return view('books.edit', compact('book'));
    }
public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'author' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'publisher' => 'sometimes|required|string|max:255',
            'publishyear' => 'sometimes|required|integer',
            'edition' => 'sometimes|required|integer',
            'isbn' => 'sometimes|required|string|max:13|unique:books,isbn,' . $book->id,
            'loanaable' => 'sometimes|required|boolean',
        ]);
        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'A könyv sikeresen módosítva.');
    }
    public function destroy(Book $book)
    {
        if($book->loans){return redirect()->route('books.index')->with('warning', 'A könyv nem törölhető, mert ki van kölcsönözve.');}
        $book->delete();
        return redirect()->route('books.index')->with('success', 'A könyv sikeresen törölve.');
    }
}