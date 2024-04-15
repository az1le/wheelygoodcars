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
                            @if ($car->image != '')
                                <td>
                                    <img src="{{ Storage::url($car->image) }}" class="img-fluid img-thumbnail" height="100" width="100" alt="Auto">
                                </td>
                            @else
                                <td></td>
                            @endif
                            <td>
                                <div>
                                    {{ $car->license_plate }}
                                </div>
                                <div>
                                    <span class="badge text-bg-success">Te koop</span>
                                    {{-- <div><span class="badge text-bg-warning">Verkocht</span></div> --}}
                                </div>
                            </td>
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
