@extends('layouts.app')

@section('content')
    <h2>Alle auto's</h2>

    @if ($cars->isEmpty())
        <p>Geen offertes momenteel beschikbaar.</p>
    @else
        <table class="table">
            @foreach ($cars as $car)
                <tbody>
                    <tr>
                        <th>{{ $car->license_plate }}</th>
                        <td>&euro;{{ $car->price }}</td>
                        <td>{{ $car->brand }} {{ $car->model }} {{ $car->production_year }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    @endif

@endsection
