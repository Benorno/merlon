@extends('index')

@section('siteTitle', 'Merlon | About Us')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 30svh">
        <div class="container">
            <div class="row">
                <h1 class="fw-semibold">About Us</h1>
                <div class="mt-4">
                    <p>MERLON is a Lithuanian based distribution company of leading brands with focus on innovative, modern
                        products for HORECA sector.
                        <br>
                        We believe that quality and sustainibility go hand in hand. Quality product that lasts and is
                        reusable is sustainability at it's best.
                        <br>
                        MERLON offers complete logistical solutions to retailer & wholesaler, very flexible product
                        customisation.
                        <br>
                        Our office and warehouse is located in Klaipeda, Lithuania. We distribute our products in Baltic
                        states & Finland</p>
                        <br>
                        <img src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo" style="width: 150px; filter: invert(100%);">
                </div>
            </div>
        </div>
    </main>
@endsection
