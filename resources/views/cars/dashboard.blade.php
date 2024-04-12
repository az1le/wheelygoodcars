@extends('layouts.app')

@section('content')
    <h2>Mijn aanbod</h2>

    @if ($cars->isEmpty())
        <p>U heeft momenteel geen aanbod.</p>
    @else
        <div class="table-responsive mt-4">
            <table class="table">
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->license_plate }}</td>
                            <td>&euro;{{ number_format($car->price, 2, ',', '.') }}</td>
                            <td>{{ $car->brand }} {{ $car->model }} {{ $car->production_year }}</td>
                            <td class="text-end"><a href="{{ route('cars.edit', $car) }}"><i class="fa-solid fa-pen"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
