@extends('layouts.app')

@section('content')
    <h2>Mijn aanbod</h2>

    @if ($cars->isEmpty())
        <p>U heeft momenteel geen aanbod.</p>
    @else
        <table class="table">
            @foreach ($cars as $car)
                <tbody>
                    <tr>
                        <th>{{ $car->license_plate }}</th>
                        <td>&euro;{{ $car->price }}</td>
                        <td>{{ $car->brand }} {{ $car->model }} {{ $car->production_year }}</td>
                        <td>
                            <div class="d-inline-block">
                                <a href="" class="btn btn-info">Aanpassen</a>
                            </div>
                            <div class="d-inline-block">
                                <form action="{{ route('cars.destroy', $car->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Verwijderen" class="btn btn-danger">
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    @endif
@endsection
