@extends('layouts.app')

@section('content')
    <div class="row rounded shadow-lg">
        <div class="col-4 bg-primary rounded-start"></div>
        <div class="col-8 p-5">
            <div class="d-flex justify-content-between">
                <h2 class="mb-0">Aanbod aanpassen</h2>
                <a href="{{ route('cars.dashboard') }}" class="btn btn-primary text-white shadow-sm"><i class="fas fa-arrow-left"></i> Terug</a>
            </div>

            <form action="{{ route('cars.update', $car->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mt-4">
                    <label for="license_plate">Kenteken</label>
                    <input type="text" id="license_plate" class="form-control shadow-sm" value="{{ $car->license_plate }}" disabled>
                </div>

                <div class="form-group mt-4">
                    <label for="brand">Merk</label>
                    <input type="text" id="brand" class="form-control shadow-sm" value="{{ $car->brand }}" disabled>
                </div>

                <div class="form-group mt-4">
                    <label for="model">Model</label>
                    <input type="text" id="model" class="form-control shadow-sm" value="{{ $car->model }}" disabled>
                </div>

                <div class="row mt-4">
                    <div class="form-group col-md-4">
                        <label for="seats">Zitplaatsen</label>
                        <input type="text" id="seats" class="form-control shadow-sm" value="{{ $car->seats ?? '-' }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="doors">Aantal deuren</label>
                        <input type="text" id="doors" class="form-control shadow-sm" value="{{ $car->doors ?? '-' }}" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="weight">Massa rijklaar</label>
                        <input type="text" id="weight" class="form-control shadow-sm" value="{{ $car->weight ?? '-' }}" disabled>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="form-group col-md-6">
                        <label for="production_year">Jaar van productie</label>
                        <input type="text" id="production_year" class="form-control shadow-sm" value="{{ $car->production_year ?? '-' }}" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color">Kleur</label>
                        <input type="text" id="color" class="form-control shadow-sm" value="{{ $car->color ?? '-' }}" disabled>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label for="mileage">Kilometerstand</label>
                    <div class="input-group">
                        <input type="text" id="mileage" class="form-control shadow-sm" value="{{ number_format($car->mileage, 0, ',', '.') }}" disabled>
                        <span class="input-group-text shadow-sm">km</span>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label for="price">Vraagprijs</label>
                    <div class="input-group">
                        <span class="input-group-text shadow-sm">&euro;</span>
                        <input type="text" id="price" class="form-control shadow-sm" name="price" value="{{ number_format($car->price, 2, ',', '.') }}">
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success shadow-sm">Opslaan</button>
                    <button type="button" onclick="confirmDelete()" class="btn btn-danger shadow-sm"><i class="fas fa-trash"></i></button>
                </div>
            </form>
            <form action="{{ route('cars.destroy', $car) }}" method="post" id="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="d-none"></button>
            </form>
        </div>
    </div>

    <script>
        function confirmDelete() {
            if (confirm('Weet u zeker dat u deze aanbod wilt verwijderen?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endsection
