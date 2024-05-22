@extends('layout')

@section('content')
<div class="container">
    <h1>Új könyvtári tag felvétele</h1>

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

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nev">Név</label>
            <input type="text" class="form-control" id="nev" name="nev" value="{{ old('nev') }}" required>
        </div>
        <div class="form-group">
            <label for="lakcim">Lakcím</label>
            <input type="text" class="form-control" id="lakcim" name="lakcim" value="{{ old('lakcim') }}" required>
        </div>
        <div class="form-group">
            <label for="emailcim">Elérhetőség (e-mail)</label>
            <input type="email" class="form-control" id="lakcim" name="emailcim" value="{{ old('emailcim') }}" required>
        </div>
        <div class="form-group">
            <label for="tipus">Könyvtári tagság típusa</label>
            <select class="form-control" id="tipus" name="tipus" required>
                <option value="eo">Egyetemi oktató</option>
                <option value="eh">Egyetemi hallgató</option>
                <option value="mp">Más egyetem polgára</option>
                <option value="mm">Mindenki más</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tag felvétele</button>
    </form>
</div>
@endsection