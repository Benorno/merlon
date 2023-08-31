@extends('index')

@section('siteTitle', 'Merlon | Products')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <main class="container-fluid">
        <div class="row my-3 p-3">
            <div class="col">
                <h1 class="ms-5">Product Listing</h1>
            </div>
            <div class="col">
                <form action="{{ route('admin.products.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control rounded-0 border-2 border-dark"
                            placeholder="Search by product name or product code">
                        <button type="submit" class="btn btn-outline-dark border-2 rounded-0 ms-3"><i
                                class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="float-end">
                    <a href="{{ route('products.create') }}"
                        class="btn btn-outline-dark rounded-0 border-2 fw-semibold">Create Product</a>
                </div>
            </div>
        </div>
        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock Quantity</th>
                    <th>Visibility</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><a href="{{ route('admin.products.edit', ['id' => $product->id]) }}""><img
                                    src="{{ asset('storage/' . $product->photo) }}" style="width: 25px"
                                    class="card-img-top rounded-0" alt="{{ $product->name }}"></a></td>
                        <td>{{ $product->product_code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->category)
                                {{ $product->category->title }}
                            @else
                                <span class="text-danger text-uppercase fw-semibold">not assigned</span>
                            @endif
                        </td>
                        <td>{{ $product->price }}€</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>
                            @if ($product->is_hidden)
                                <span class="text-danger"><i class="bi bi-eye-slash"></i> Hidden</span>
                            @else
                                <span class="text-success"><i class="bi bi-eye"></i> Visible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                class="btn btn-sm btn-outline-primary rounded-pill border-0"><i
                                    class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
