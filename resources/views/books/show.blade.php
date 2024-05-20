@extends('layout')

@section('content')
<div class="container">
    <h1>Könyv adatai</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $book->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
            <p class="card-text"><strong>Kiadó:: </strong> {{ $book->publisher }}</p>
            <p class="card-text"><strong>Kiadás éve: </strong> {{ $book->publishyear }}</p>
            <p class="card-text"><strong>Kiadás: </strong> {{ $book->edition }}</p>
            <p class="card-text"><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p class="card-text"><strong>Kölcsönözhető: </strong> {{ $book->loanable? 'Yes' : 'No' }}</p>
          <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Módosítás</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztosan törölni szeretné a könyvet?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Törlés</button>
            </form>
        </div>
    </div>
</div>
@endsection