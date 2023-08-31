@extends('index')

@section('siteTitle', 'Merlon | Thank You')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 30svh">
        <div class="container text-center">
            <div class="row">
                <h1>Thank You.</h1>
                <p>We'll send You and estimate shortly!</p>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-dark rounded-0 border-2 fw-semibold">See other products</a>
                </div>
            </div>
        </div>
    </main>
@endsection
