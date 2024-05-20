@extends('layout')

@section('content')
<div class="container">
    <h1>Könyv módosítása</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="author">Szerző</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $book->author) }}" required>
        </div>
        <div class="form-group">
            <label for="title">Cím</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}" required>
        </div>
        <div class="form-group">
            <label for="publisher">Kiadó</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}" required>
        </div>
        <div class="form-group">
            <label for="publishyear">Kiadás éve</label>
            <input type="number" class="form-control" id="publishyear" name="publishyear" value="{{ old('publishyear', $book->publishyear) }}" required>
</div>
        <div class="form-group">
            <label for="edition">Kiadás</label>
            <input type="number" class="form-control" id="edition" name="edition" value="{{ old('edition', $book->edition) }}" required>
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
        </div>
        <div class="form-group">
            <label for="loanable">Kölcsönöözhető</label>
            <select class="form-control" id="loanable" name="loanable" required>
                <option value="1" {{ old('loanable', $book->loanable) == '1' ? 'selected' : '' }}>Igen</option>
                <option value="0" {{ old('loanable', $book->loanable) == '0' ? 'selected' : '' }}>Nem</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Könyv módosításainak mentése</button>
    </form>
</div>
@endsection