@extends('index')

@section('siteTitle', 'Merlon | No product Found')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 30svh">
        <div class="container text-center">
            <div class="row">
                <h1>Sorry, no product found.</h1>
                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-dark rounded-0 border-2 fw-semibold">See other products</a>
                </div>
            </div>
        </div>
    </main>
@endsection
