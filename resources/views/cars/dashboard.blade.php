@extends('layouts.app')

@section('content')
    <h2>Mijn aanbod</h2>

    @if ($cars->isEmpty())
        <p>U heeft momenteel geen aanbod.</p>
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Kenteken</th>
                    <th>Vraagprijs</th>
                    <th>Details</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->license_plate }}</td>
                        <td>&euro;{{ number_format($car->price, 2, ',', '.') ?? '' }}</td>
                        <td>{{ $car->brand }} {{ $car->model }} {{ $car->production_year }}</td>
                        <td><a href=""><i class="fa-solid fa-pen"></i></a></td>
                        <td>
                            <form action="{{ route('cars.destroy', $car->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="#" onclick="event.preventDefault(); return confirm('Weet u zeker dat u deze aanbod wilt verwijderen?'); this.closest('form').submit();">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
