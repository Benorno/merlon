@extends('index')

@section('siteTitle', 'Merlon | 404 | Not Found')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 30svh">
        <div class="container text-center">
            <div class="row">
                <h1>Woops, we don't have what You are looking for.</h1>
                <div class="mt-4">
                    <a href="/" class="btn btn-outline-dark rounded-0 border-2 fw-semibold">Go Home</a>
                </div>
            </div>
        </div>
    </main>
@endsection
