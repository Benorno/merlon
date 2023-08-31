@extends('index')

@section('siteTitle', 'Merlon | Something went wrong')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 30svh">
        <div class="container text-center">
            <div class="row">
                <h1>Woops, something went wrong on our end.</h1>
                <div class="mt-4">
                    <a href="mailto:info@merlon.lt" class="btn btn-outline-dark rounded-0 border-2 fw-semibold">Report a problem</a>
                    <br>
                    <br>
                    <a href="/" class="btn btn-outline-dark rounded-0 border-2 fw-semibold">Go Home</a>
                </div>
            </div>
        </div>
    </main>
@endsection
