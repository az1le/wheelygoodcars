@extends('layouts.app')

@section('content')
    <h2>Mijn aanbod</h2>

    @if ($cars->isEmpty())
        <p>U heeft momenteel geen aanbod.</p>
    @else
        <div class="table-responsive mt-4">
            <table class="table border">
                <tbody>
                    @foreach ($cars as $car)
                        <tr class="align-middle">
                            <td class="col-2">
                                @if ($car->image != '')
                                    <img src="{{ Storage::url($car->image) }}" class="img-fluid img-thumbnail" alt="Auto">
                                @else
                                    <img src="https://placehold.co/200x100?text=Geen+afbeelding" class="img-fluid img-thumbnail" alt="Placeholder">
                                @endif
                            </td>
                            <td class="col-1 text-center">
                                <div>
                                    <h5>{{ $car->license_plate }}</h5>
                                </div>
                                <div>
                                    <span class="badge text-bg-success">Te koop</span>
                                    {{-- <div><span class="badge text-bg-warning">Verkocht</span></div> --}}
                                </div>
                            </td>
                            <td class="text-center">&euro;{{ number_format($car->price, 2, ',', '.') }}</td>
                            <td>{{ $car->brand }} {{ $car->model }} {{ $car->production_year }}</td>
                            <td class="text-end"><a href="{{ route('cars.edit', $car) }}"><i class="fa-solid fa-pen"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
