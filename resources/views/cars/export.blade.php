<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            background-color: #f2f2f2;
            color: #19180A;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            text-align: center;
            border-radius: 10px;
            padding: 30px;
        }

        .header h1 {
            background-color: black;
            color: #fff;
            border-radius: 10px 10px 0 0;
            margin-top: 0;
            margin-bottom: 25px;
            padding: 15px;
        }

        .car-info p {
            margin: 10px 0;
        }

        .price-highlight {
            font-size: 20px;
            color: #fff;
            background-color: #ff7700;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .contact-info {
            color: #888;
            margin-top: 50px;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .footer {
            background-color: black;
            border-radius: 0 0 10px 10px;
            margin-top: 25px;
            padding: 15px;
        }

        .text-primary {
            color: #ff7700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $title }}</h1>
        </div>
        @if ($car->image != '')
            <img src="{{  asset(Storage::url($car->image)) }}" alt="Auto" style="height: 250px; border-radius: 5px; margin: 25px 0;">
        @endif
        <div class="car-info">
            <p><strong>Kenteken:</strong> {{ $car->license_plate }}</p>
            <p><strong>Merk:</strong> {{ $car->brand }}</p>
            <p><strong>Model:</strong> {{ $car->model }}</p>
            <p><strong>Zitplaatsen:</strong> {{ $car->seats }}</p>
            <p><strong>Aantal deuren:</strong> {{ $car->doors }}</p>
            <p><strong>Massa rijklaar:</strong> {{ $car->weight }}</p>
            <p><strong>Jaar van productie:</strong> {{ $car->production_year }}</p>
            <p><strong>Kleur:</strong> {{ $car->color }}</p>
            <p><strong>Kilometerstand:</strong> {{ number_format($car->mileage, 0, ',', '.') }} km</p>
            <p><strong>Vraagprijs:&nbsp;</strong><span class="price-highlight">&euro;{{ number_format($car->price, 2, ',', '.') }}</span></p>
        </div>
        <div class="contact-info">
            {{-- TODO: Contactgegevens evt. dynamisch maken --}}
            <p>Voor vragen kunt u contact opnemen met: info@example.com</p>
            <p>Telefoonnr: +1234567890</p>
        </div>
        <div class="footer">
            <strong style="color: white">&copy;&nbsp;<span class="text-primary">Wheely</span> good cars<span class="text-primary">!</span></strong>
        </div>
    </div>
</body>
</html>
