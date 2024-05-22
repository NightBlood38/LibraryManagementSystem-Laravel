@extends('layout')
@section('content')
<div class="container">
    <h1>Új könyv felvétele</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="author">Szerző</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
        </div>
        <div class="form-group">
            <label for="title">Cím</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="publisher">Kiadó</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}" required>
        </div>
        <div class="form-group">
            <label for="publishyear">Kiadás éve</label>
            <input type="number" class="form-control" id="publishyear" name="publishyear" value="{{ old('publishyear') }}" required>
        </div>
<div class="form-group">
            <label for="edition">Kiadás</label>
            <input type="number" class="form-control" id="edition" name="edition" value="{{ old('edition') }}" required>
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" value="{{ old('isbn') }}" required>
        </div>
        <div class="form-group">
            <label for="loanable">Kölcsönözhető</label>
            <select class="form-control" id="loanable" name="loanable" required>
                <option value="1" {{ old('loanable') == '1' ? 'selected' : '' }}>Igen</option>
                <option value="0" {{ old('loanable') == '0' ? 'selected' : '' }}>Nem</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Könyv felvétele</button>
    </form>
</div>
@endsection