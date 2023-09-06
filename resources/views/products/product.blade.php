@extends('index')

@section('siteTitle', 'Merlon | Products')

@section('content')
    <header class="fixed-top" style="background-color: #131617;">
        @include('components.header')
    </header>
    <main style="margin-top: 11svh; overflow-x: hidden">
        <div class="container">
            <div class="row">
                <h1>Our Products</h1>
                <h1 class="fw-semibold text-capitalize" style="font-size: 4svw">{{ $product->name }}</h2>
            </div>
            <form action="{{ route('cart.add', ['productId' => $product->id]) }}" method="POST">
                @csrf
                <div class="card m-3 rounded-0 border-0 border-dark p-4">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($product->photo)
                                <img src="{{ asset('storage/' . $product->photo) }}" class="img-fluid p-4"
                                    style="height: 500px; object-fit: contain; object-position: center;"
                                    alt="{{ $product->name }}">
                            @else
                                <p>No photo available</p>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col col-md-6">
                                        <h3 class="card-title fw-bold text-capitalize">{{ $product->name }}</h3>
                                    </div>
                                    <div class="col-5 col-md-4">
                                        <h5 class="card-text fw-bold mt-1">Stock Program:</h5>
                                    </div>
                                    <div class="col mt-3 mt-lg-1">
                                        <h5 class="fw-semibold">
                                            @if ($product->stockable)
                                                <span class="text-success fw-bold">Yes</span>
                                            @else
                                                <span class="text-danger fw-bold">No</span>
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <hr>
                                    <div class="col-6">
                                        <p class="card-text">Product Code:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold text-uppercase">{{ $product->product_code }}</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Material:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold text-capitalize">{{ $product->material }}</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Top Width:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">{{ $product->top_width }} mm</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Bottom Width:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">{{ $product->bottom_width }} mm</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Overall Height:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">{{ $product->height }} mm</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Weight:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">{{ $product->weight }} gr</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <p class="card-text">Quantity In Box:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">{{ $product->quantity_carton }}</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Nucleated:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">
                                            @if ($product->nucleated)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </p>
                                    </div>
                                    <hr>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text">Origin:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">{{ $product->origin }}</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text mb-3">Description:</p>
                                    </div>
                                    <div class="col">
                                        <p class="fw-semibold">{{ $product->description }}</p>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <form action="{{ route('cart.add', ['productId' => $product->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input type="number" class="form-control border-dark border-2 rounded-0"
                                                    id="quantity" name="quantity" value="1" min="1"
                                                    style="width:80px">
                                            </div>
                                            <button type="submit"
                                                class="btn btn-outline-dark rounded-0 border-2 fw-semibold">Add to
                                                Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="container" style="margin-top: 20svh;">
            <h1 class="text-center">Popular Products</h1>
            <hr>
            <div class="row d-flex ms-5 ms-xl-2 ms-md-3 ms-lg-5 ms-xxl-0">
                @php $count = 0; @endphp
                @foreach ($mostViewedProducts as $product)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-xxl-3 col-12">
                        <div class="card mb-4 rounded-0 border-0 border-dark" style="width: 18rem; height: 20rem">
                            @if ($product->photo)
                                <a href="{{ route('product.view', ['id' => $product->id]) }}">
                                    <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top rounded-0"
                                        alt="{{ $product->name }}"
                                        style="height: 15rem; object-fit: contain; object-position: center;">
                                </a>
                            @else
                                <p>No photo available</p>
                            @endif
                            <div class="card-body text-center">
                                <a href="{{ route('product.view', ['id' => $product->id]) }}"
                                    class="fw-semibold fs-5 link-underline link-underline-opacity-0 text-dark">{{ $product->name }}</a>
                                <span class="float-end">
                                    <a href="{{ route('product.view', ['id' => $product->id]) }}"
                                        class="text-decoration-none link-dark fs-4">
                                        <i class="bi bi-arrow-right-short"></i>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    @php $count++; @endphp
                @endforeach
            </div>
        </div>


        <div class="container p-4" style="margin-top: 20svh; margin-bottom: 15svh">
            <div class="text-center">
                <h1 class="fw-bold">Have Questions?</h1>
                <p>Can't find what you're looking for? Merlon has a large selection of high-quality
                    products, so we can always find a solution that works for you. Call us or send us an
                    email and let us know what you need.</p>
                <a href="#" class="btn btn-outline-dark rounded-0 border-2 fw-semibold">Contact Us <i
                        class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </main>
@endsection
