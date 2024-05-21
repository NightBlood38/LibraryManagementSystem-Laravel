@extends('layout')
@section('content')
<div class="container">
    <h2>{{ $member->nev }} Kölcsönzései</h2>

    <h3>Aktuális Kölcsönzések</h3>
    @if ($currentLoans->isEmpty())
    <p>Nincsenek aktuális kölcsönzések.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Könyv Címe</th>
                <th>Kölcsönzés Dátuma</th>
                <th>Visszahozás Dátuma</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($currentLoans as $loan)
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->loan_date }}</td>
                <td>{{ $loan->return_date }}</td>
                <td>
                    <form action="{{ route('loans.return_book', $loan->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Visszavétel</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
<h3>Visszahozott Kölcsönzések</h3>
    @if ($returnedLoans->isEmpty())
    <p>Nincsenek visszahozott kölcsönzések.</p>
    @else
    <table class="table">
        <thead>
            <tr>
                <th>Könyv Címe</th>
                <th>Kölcsönzés Dátuma</th>
                <th>Visszahozás Dátuma</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returnedLoans as $loan)
            <tr>
                <td>{{ $loan->book->title }}</td>
                <td>{{ $loan->loan_date }}</td>
                <td>{{ $loan->return_date }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection