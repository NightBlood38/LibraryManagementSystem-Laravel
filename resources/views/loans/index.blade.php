@extends('layout')
@section('content')
<div class="container">
    <h1>Könyvek</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Új könyv felvétele</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Szerző</th>
                <th>Cím</th>
                <th>Kiadó</th>
                <th>Kiadás éve</th>
                <th>Kiadás</th>
                <th>ISBN</th>
                <th>Kölcsönözhető-e?</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->publisher }}</td>
                    <td>{{ $book->publishyear }}</td>
                    <td>{{ $book->edition }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->loanable ? 'Igen' : 'Nem' }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">Megtekintés</a>
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Módosítás</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Törlés</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection