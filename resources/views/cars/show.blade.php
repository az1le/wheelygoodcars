@extends('layouts.app')

@section('content')
<div class="card col-12 col-sm-8 col-lg-4 shadow mx-auto">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Detailpagina</h5>
    </div>
    <div class="card-body">
        <dl class="row mb-0">
            <dt class="col-sm-5">Kenteken:</dt>
            <dd class="col-sm-7">{{ $car->license_plate }}</dd>

            <dt class="col-sm-5">Merk:</dt>
            <dd class="col-sm-7">{{ $car->brand }}</dd>

            <dt class="col-sm-5">Model:</dt>
            <dd class="col-sm-7">{{ $car->model }}</dd>

            <dt class="col-sm-5">Zitplaatsen:</dt>
            <dd class="col-sm-7">{{ $car->seats ?? '-' }}</dd>

            <dt class="col-sm-5">Aantal deuren:</dt>
            <dd class="col-sm-7">{{ $car->doors ?? '-' }}</dd>

            <dt class="col-sm-5">Massa rijklaar:</dt>
            <dd class="col-sm-7">{{ $car->weight ?? '-' }}</dd>

            <dt class="col-sm-5">Jaar van productie:</dt>
            <dd class="col-sm-7">{{ $car->production_year ?? '-' }}</dd>

            <dt class="col-sm-5">Kleur:</dt>
            <dd class="col-sm-7">{{ $car->color ?? '-' }}</dd>

            <dt class="col-sm-5">Kilometerstand:</dt>
            <dd class="col-sm-7">{{ number_format($car->mileage, 0, ',', '.') ?? '' }}</dd>

            <dt class="col-sm-5">Vraagprijs:</dt>
            <dd class="col-sm-7">&euro;{{ number_format($car->price, 2, ',', '.') ?? '' }}</dd>
        </dl>
    </div>
    <div class="card-footer bg-white text-end">
        <a href="{{ route('cars.index') }}" class="btn btn-primary text-white shadow-sm"><i class="fas fa-arrow-left"></i> Terug</a>
    </div>
</div>
@endsection
