@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('cars.store') }}" id="multistep-form">
    @csrf
    <div id="step-1" class="form-step">
        <div class="form-group">
            <label for="license_plate">Kenteken</label>
            <input type="text" name="license_plate" class="form-control" id="license_plate_step1" placeholder="Kenteken invoeren" oninput="fetchCarInfo(this.value)" required>
        </div>

        <button type="button" onclick="nextStep(2)" class="btn btn-primary mt-4">Volgende</button>
    </div>

    <div id="step-2" class="form-step" style="display: none;">
        <h2>Nieuw aanbod</h2>
        
        <div class="form-group mt-4">
            <label for="license_plate">Kenteken</label>
            <input type="text" name="license_plate" class="form-control" id="license_plate_step2" value="{{ isset($carData[0]['kenteken']) ? $carData[0]['kenteken'] : '' }}" required>
        </div>

        <div class="form-group mt-4">
            <label for="brand">Merk</label>
            <input type="text" name="brand" class="form-control" id="brand" value="{{ isset($carData[0]['merk']) ? $carData[0]['merk'] : '' }}" required>
        </div>

        <div class="form-group mt-4">
            <label for="model">Model</label>
            <input type="text" name="model" class="form-control" id="model" value="{{ isset($carData[0]['handelsbenaming']) ? $carData[0]['handelsbenaming'] : '' }}" required>
        </div>

        <div class="row mt-4">
            <div class="form-group col-md-4">
                <label for="seats">Zitplaatsen</label>
                <input type="text" name="seats" class="form-control" id="seats" value="{{ isset($carData[0]['aantal_zitplaatsen']) ? $carData[0]['aantal_zitplaatsen'] : '' }}">
            </div>
            <div class="form-group col-md-4">
                <label for="doors">Aantal deuren</label>
                <input type="text" name="doors" class="form-control" id="doors" value="{{ isset($carData[0]['aantal_deuren']) ? $carData[0]['aantal_deuren'] : '' }}">
            </div>
            <div class="form-group col-md-4">
                <label for="weight">Massa rijklaar</label>
                <input type="text" name="weight" class="form-control" id="weight" value="{{ isset($carData[0]['massa_rijklaar']) ? $carData[0]['massa_rijklaar'] : '' }}">
            </div>
        </div>

        <div class="row mt-4">
            <div class="form-group col-md-6">
                <label for="production_year">Jaar van productie</label>
                <input type="number" name="production_year" class="form-control" id="production_year" value="{{ isset($carData[0]['datum_eerste_toelating']) ? $carData[0]['datum_eerste_toelating'] : '' }}">
            </div>
            <div class="form-group col-md-6">
                <label for="color">Kleur</label>
                <input type="text" name="color" class="form-control" id="color" value="{{ isset($carData[0]['eerste_kleur']) ? $carData[0]['eerste_kleur'] : '' }}">
            </div>
        </div>

        <div class="form-group mt-4">
            <label for="mileage">Kilometerstand</label>
            <div class="input-group mb-3">
                <input type="text" name="mileage" class="form-control" id="mileage" required>
                <span class="input-group-text">km</span>
            </div>
        </div>

        <div class="form-group mt-4">
            <label for="price">Vraagprijs</label>
            <div class="input-group mb-3">
                <span class="input-group-text">&euro;</span>
                <input type="text" name="price" class="form-control" id="price" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Aanbod afronden</button>
    </div>
</form>

<script>
    function nextStep(step) {
        document.getElementById(`step-${step - 1}`).style.display = 'none';
        document.getElementById(`step-${step}`).style.display = 'block';
    }

    async function fetchCarInfo(licensePlate) {
        try {
            const response = await fetch(`https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=${licensePlate}`);

            if (!response.ok) {
                throw new Error('Failed to fetch car information');
            }

            const [carData] = await response.json();

            populateForm(carData);
        } catch (error) {
            console.error('Error fetching car information:', error);
        }
    }

    function populateForm(carData) {
        const {
            kenteken,
            merk,
            handelsbenaming,
            aantal_zitplaatsen,
            aantal_deuren,
            massa_rijklaar,
            datum_eerste_toelating,
            eerste_kleur
        } = carData || {};

        document.getElementById('license_plate_step2').value = kenteken || '';
        document.getElementById('brand').value = merk || '';
        document.getElementById('model').value = handelsbenaming || '';
        document.getElementById('seats').value = aantal_zitplaatsen || '';
        document.getElementById('doors').value = aantal_deuren || '';
        document.getElementById('weight').value = massa_rijklaar || '';
        document.getElementById('production_year').value = datum_eerste_toelating ? datum_eerste_toelating.substring(0, 4) : '';
        document.getElementById('color').value = eerste_kleur || '';
    }
</script>
@endsection
