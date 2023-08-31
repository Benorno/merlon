@extends('index')

@section('siteTitle', 'Merlon | Order')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 11svh">
        @include('orders.main')
    </main>
@endsection
