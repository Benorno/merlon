@extends('index')

@section('siteTitle', 'Merlon | Profile')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <main>
        @include('admin.profile.main')
    </main>
@endsection
