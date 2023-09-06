@extends('index')

@section('siteTitle', 'Merlon | Subcategories')

@section('content')
    <header style="background-color: #131617">
        @include('components.header')
    </header>
    <div class="container" style="margin-top: 3rem">
        <h1 class="mb-4">{{ $subcategory->title }} Products</h1>
        <div class="row ms-5 ms-xl-4">
            @foreach ($products as $product)
                @if (!$product->is_hidden)
                    <!-- Check if the product is not hidden -->
                    <div class="col-md-6 col-12 col-lg-4 col-xl-3 mb-4">
                        <div class="card rounded-0 border-0 border-dark" style="width: 16rem">
                            @if ($product->photo)
                                <a href="{{ route('product.show', ['id' => $product->id]) }}"><img
                                        src="{{ asset('storage/' . $product->photo) }}" class="card-img-top rounded-0"
                                        alt="{{ $product->name }}"></a>
                            @else
                                <a href="{{ route('product.show', ['id' => $product->id]) }}"><img
                                        src="{{ asset('placeholder.jpg') }}" class="card-img-top" alt="Placeholder"></a>
                            @endif
                            <div class="card-body" style="background-color: #0C141C">
                                <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                    class="link-light text-decoration-none fw-semibold fs-5">{{ $product->name }}</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
