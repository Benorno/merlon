@extends('index')

@section('siteTitle', 'Merlon | Categories')

@section('content')
    <header style="background-color: #131617">
        @include('components.header')
    </header>
    <div class="container" style="margin-top: 3rem">
        <h1 class="mb-4">{{ $category->title }}</h1> <!-- Display the category title -->
        <div class="row ms-5 ms-xl-4">
            @foreach ($subcategories as $subcategory)
                @if (!$subcategory->is_hidden)
                    <!-- Check if the subcategory is not hidden -->
                    <div class="col-md-6 col-12 col-lg-4 col-xl-3 mb-4">
                        <div class="card rounded-0 border-0 border-dark" style="width: 16rem">
                            @if ($subcategory->subcategory_photo)
                                <a href="{{ route('subcategories.show', ['subcategory' => $subcategory]) }}"><img
                                        src="{{ asset('storage/' . $subcategory->subcategory_photo) }}" class="card-img-top rounded-0"
                                        alt="{{ $subcategory->title }}"></a> <!-- Access the title property -->
                            @else
                                <a href="{{ route('subcategories.show', ['id' => $subcategory->id]) }}"><img
                                        src="{{ asset('placeholder.jpg') }}" class="card-img-top" alt="Placeholder"></a>
                            @endif
                            <div class="card-body" style="background-color: #0C141C">
                                <a href="{{ route('subcategories.show', ['subcategory' => $subcategory]) }}"
                                    class="link-light text-decoration-none fw-semibold fs-5">{{ $subcategory->title }}</a> <!-- Access the title property -->
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
