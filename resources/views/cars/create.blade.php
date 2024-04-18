@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('cars.store') }}" id="multistep-form" enctype="multipart/form-data">
    @csrf
    <div id="step-1" class="form-step col-12 col-sm-6 mx-auto">
        <h2>Nieuw aanbod</h2>

        <div class="input-group border-black mt-4 border border-black rounded shadow-lg">
            <div class="input-group-text text-white border border-black shadow-sm" style="background-color: blue">NL</div>
            <input type="text" name="license_plate" class="form-control form-control-lg bg-warning text-center fw-bold border border-black shadow-sm" id="license_plate_step1" placeholder="AA-BB-12" oninput="fetchCarInfo(this.value)" required>
            <button type="button" onclick="nextStep(2)" class="btn btn-dark border border-black shadow-sm">Volgende</button>
        </div>
    </div>

    <div id="step-2" class="form-step" style="display: none;">
        <div class="row rounded shadow-lg">
            <div class="col-4 bg-primary rounded-start"></div>
            <div class="col-8 p-5">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-0">Nieuw aanbod</h2>
                    <a href="{{ route('cars.create') }}" class="btn btn-primary text-white shadow-sm"><i class="fas fa-arrow-left"></i> Terug</a>
                </div>

                <div class="form-group mt-4">
                    <label for="license_plate" class="form-label">Kenteken</label>
                    <input type="text" name="license_plate" class="form-control shadow-sm" id="license_plate_step2" value="{{ isset($carData[0]['kenteken']) ? $carData[0]['kenteken'] : '' }}" required>
                </div>

                <div class="form-group mt-4">
                    <label for="brand" class="form-label">Merk</label>
                    <input type="text" name="brand" class="form-control shadow-sm" id="brand" value="{{ isset($carData[0]['merk']) ? $carData[0]['merk'] : '' }}" required>
                </div>

                <div class="form-group mt-4">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" name="model" class="form-control shadow-sm" id="model" value="{{ isset($carData[0]['handelsbenaming']) ? $carData[0]['handelsbenaming'] : '' }}" required>
                </div>

                <div class="row mt-4">
                    <div class="form-group col-md-4">
                        <label for="seats" class="form-label">Zitplaatsen</label>
                        <input type="text" name="seats" class="form-control shadow-sm" id="seats" value="{{ isset($carData[0]['aantal_zitplaatsen']) ? $carData[0]['aantal_zitplaatsen'] : '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="doors" class="form-label">Aantal deuren</label>
                        <input type="text" name="doors" class="form-control shadow-sm" id="doors" value="{{ isset($carData[0]['aantal_deuren']) ? $carData[0]['aantal_deuren'] : '' }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="weight" class="form-label">Massa rijklaar</label>
                        <input type="text" name="weight" class="form-control shadow-sm" id="weight" value="{{ isset($carData[0]['massa_rijklaar']) ? $carData[0]['massa_rijklaar'] : '' }}">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="form-group col-md-6">
                        <label for="production_year" class="form-label">Jaar van productie</label>
                        <input type="number" name="production_year" class="form-control shadow-sm" id="production_year" value="{{ isset($carData[0]['datum_eerste_toelating']) ? $carData[0]['datum_eerste_toelating'] : '' }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color" class="form-label">Kleur</label>
                        <input type="text" name="color" class="form-control shadow-sm" id="color" value="{{ isset($carData[0]['eerste_kleur']) ? $carData[0]['eerste_kleur'] : '' }}">
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label for="mileage" class="form-label">Kilometerstand</label>
                    <div class="input-group">
                        <input type="text" name="mileage" class="form-control shadow-sm" id="mileage" required>
                        <span class="input-group-text shadow-sm">km</span>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label for="price" class="form-label">Vraagprijs</label>
                    <div class="input-group">
                        <span class="input-group-text shadow-sm">&euro;</span>
                        <input type="text" name="price" class="form-control shadow-sm" id="price" required>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label for="image" class="form-label">Afbeelding</label>
                    <input type="file" name="image"  class="form-control shadow-sm" id="image">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success shadow-sm mt-4">Aanbod afronden</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function nextStep(step) {
        if (step === 2) {
            const licensePlate = document.getElementById('license_plate_step1').value.trim();
            if (licensePlate === '') {
                alert('Vul a.u.b. het kenteken in.');
                return;
            }
        }

        document.getElementById(`step-${step - 1}`).style.display = 'none';
        document.getElementById(`step-${step}`).style.display = 'block';
    }

    async function fetchCarInfo(licensePlate) {
        try {
            const formattedLicensePlate = licensePlate.replace(/-/g, '');

            const response = await fetch(`https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=${formattedLicensePlate}`);

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
