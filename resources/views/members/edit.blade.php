@extends('layout')

@section('content')
<div class="container">
    <h1>Könyvtári tag adatainak módosítása</h1>

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

    <form action="{{ route('members.update', $member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nev">Név</label>
            <input type="text" class="form-control" id="nev" name="nev" value="{{ old('nev', $member->nev) }}" required>
        </div>
        <div class="form-group">
            <label for="lakcim">Lakcím</label>
            <input type="text" class="form-control" id="lakcim" name="lakcim" value="{{ old('lakcim', $member->lakcim) }}" required>
        </div>
        <div class="form-group">
            <label for="emailcim">Elérhetőség (e-mail)</label>
            <input type="email" class="form-control" id="emailcim" name="emailcim" value="{{ old('emailcim', $member->emailcim) }}" required>
        </div>
        <div class="form-group">
            <label for="tipus">Könyvtári tagság típusa</label>
            <select class="form-control" id="tipus" name="tipus" required>
                <option value="eo" {{ old('tipus', $member->tipus) == 'eo' ? 'selected' : '' }}>Egyetemi oktató</option>
                <option value="eh" {{ old('tipus', $member->tipus) == 'eh' ? 'selected' : '' }}>Egyetemi hallgató</option>
                <option value="mp" {{ old('tipus', $member->tipus) == 'mp' ? 'selected' : '' }}>Más egyetem polgára</option>
                <option value="mm" {{ old('tipus', $member->tipus) == 'mm' ? 'selected' : '' }}>Mindenki más</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Adatok módosítása</button>
    </form>
</div>
@endsection
