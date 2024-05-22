@extends('layout')

@section('content')
<div class="container">
    <h1>Könyvtári tag adatai</h1>
    <a href="{{ route('members.loans', $member->id) }}" class="btn btn-primary">Kölcsönzések</a>
    <p>Név: {{ $member->nev }}</p>
    <p>Lakcím: {{ $member->lakcim }}</p>
    <p>Elérhetőség: {{ $member->emailcim }}</p>
    <p>Könyvtári tagság: {{ $member->hosszutipus() }}</p>

    <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning">Módosítás</a>
    <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Biztosan törölni szeretné ezt a könyvtári tagot?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
