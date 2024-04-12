@extends('layouts.app')

@section('content')
    <h2>Alle auto's</h2>

    @if ($cars->isEmpty())
        <p>Geen offertes momenteel beschikbaar.</p>
    @else
        <table class="table mt-4">
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->license_plate }}</td>
                        <td>&euro;{{ number_format($car->price, 2, ',', '.') }}</td>
                        <td>{{ $car->brand }} {{ $car->model }} {{ $car->production_year }}</td>
                        <td class="text-end"><a href="{{ route('cars.show', $car) }}"><i class="fa-solid fa-eye"></i></a>
                    </tr>
                @endforeach
        </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $cars->links() }}
        </div>
    @endif
@endsection
