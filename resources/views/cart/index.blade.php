@extends('index')

@section('siteTitle', 'Merlon | Cart')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 11svh; margin-bottom: 10svh">
        @include('cart.main')
    </main>
@endsection
