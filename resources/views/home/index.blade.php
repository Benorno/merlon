@extends('index')
@section('lang', 'en')

@section('siteTitle', 'Merlon')

@section('content')
    <header class="fixed-top" style="background-color: #131617">
        @include('components.header')
    </header>
    <main style="margin-top: 5svh">
        @include('home.main')
    </main>
@endsection
