@extends('index')

@section('siteTitle', 'Merlon | Contact Us')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 30svh">
        <div class="container">
            <div class="row">
                <h1 class="fw-semibold">Contact Us</h1>
                <div class="mt-4 ms-5">
                    <p class="fs-4">Melon, MB</p>
                    <p>Email: <a href="mailto:info@merlon.lt" class="link-dark">info@merlon.lt</a></p>
                    <p>Phone: +37066920732</p>
                    <img src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo" style="width: 150px; filter: invert(100%);">
                </div>
            </div>
        </div>
    </main>
@endsection
