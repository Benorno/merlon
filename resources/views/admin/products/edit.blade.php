@extends('index')

@section('siteTitle', 'Merlon | Edit Products')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <div class="container" style="margin-top: 15svh">
        <div class="row">
            <div class="col-9">
                <div class="card rounded-0 border-0">
                    <form action="{{ route('admin.products.update', ['id' => $product->id]) }}" method="POST"
                        enctype="multipart/form-data" class="p-3">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="row my-3">
                                <div class="col">
                                    <h2>Edit Product Card</h2>
                                </div>
                                <div class="col">
                                    <a href="{{ route('admin.products.index') }}"
                                        class="btn btn-outline-dark rounded-0 border-2 float-end"><i
                                            class="bi bi-arrow-left"></i>
                                        Go back</a>
                                </div>
                            </div>
                            <hr class="border-light border-2">
                            <div class="col-4 mb-3">
                                <label for="name" class="form-label">Product Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="form-control rounded-0 border-2 border-dark" required>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="product_code" class="form-label">Product Code <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="product_code" id="product_code"
                                    value="{{ old('product_code', $product->product_code) }}"
                                    class="form-control rounded-0 border-2 border-dark" required>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-select rounded-0 border-2 border-dark" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="col-3 mb-3">
                                <label for="weight" class="form-label">Weight (g)</label>
                                <input type="text" name="weight" id="weight"
                                    value="{{ old('weight', $product->weight) }}"
                                    class="form-control rounded-0 border-2 border-dark">
                            </div>
                            <div class="col-3 mb-3">
                                <label for="top_width" class="form-label">Top Width (mm)</label>
                                <input type="text" name="top_width" id="top_width"
                                    value="{{ old('top_width', $product->top_width) }}"
                                    class="form-control rounded-0 border-2 border-dark">
                            </div>
                            <div class="col-3 mb-3">
                                <label for="bottom_width" class="form-label">Bottom Width (mm)</label>
                                <input type="text" name="bottom_width" id="bottom_width"
                                    value="{{ old('bottom_width', $product->bottom_width) }}"
                                    class="form-control rounded-0 border-2 border-dark">
                            </div>
                            <div class="col-3 mb-3">
                                <label for="height" class="form-label">Overall Height (mm)</label>
                                <input type="text" name="height" id="height"
                                    value="{{ old('height', $product->height) }}"
                                    class="form-control rounded-0 border-2 border-dark">
                            </div>

                            <div class="col-2 mb-3">
                                <label for="material" class="form-label">Material</label>
                                <input type="text" name="material" id="material"
                                    value="{{ old('material', $product->material) }}"
                                    class="form-control rounded-0 border-2 border-dark">
                            </div>
                            <div class="col-2 mb-3">
                                <label for="origin" class="form-label">Origin</label>
                                <input type="text" name="origin" id="origin"
                                    value="{{ old('origin', $product->origin) }}"
                                    class="form-control rounded-0 border-2 border-dark" value="UK">
                            </div>
                            <div class="col-3 mb-3">
                                <label for="quantity_carton" class="form-label">Quantity Per Carton</label>
                                <input type="text" name="quantity_carton" id="quantity_carton"
                                    value="{{ old('quantity_carton', $product->quantity_carton) }}"
                                    class="form-control rounded-0 border-2 border-dark" value="UK">
                            </div>
                            <div class="col-2 mb-3">
                                <label for="stockable" class="form-label">Stockable<span class="text-danger">*</span></label>
                                <br>
                                <div class="btn-group" role="group" aria-label="stockable">
                                    <input type="radio" class="btn-check" name="stockable" id="stockable"
                                        value="1" {{ $product->stockable == '1' ? 'checked' : '' }}>
                                    <label
                                        class="btn btn-outline-success me-3 rounded-0 border-2 {{ $product->stockable == '1' ? 'active' : '' }}"
                                        for="stockable">Yes</label>

                                    <input type="radio" class="btn-check" name="stockable" id="no"
                                        value="0" {{ $product->stockable == '0' ? 'checked' : '' }}>
                                    <label
                                        class="btn btn-outline-danger rounded-0 border-2 {{ $product->stockable == '0' ? 'active' : '' }}"
                                        for="no">No</label>
                                </div>
                            </div>
                            <div class="col-2 mb-3">
                                <label for="nucleated" class="form-label">Nucleated<span
                                        class="text-danger">*</span></label>
                                <br>
                                <div class="btn-group" role="group" aria-label="nucleated">
                                    <input type="radio" class="btn-check" name="nucleated" id="nucleated"
                                        value="1" {{ $product->nucleated == '1' ? 'checked' : '' }}>
                                    <label
                                        class="btn btn-outline-success me-3 rounded-0 border-2 {{ $product->nucleated == '1' ? 'active' : '' }}"
                                        for="nucleated">Yes</label>

                                    <input type="radio" class="btn-check" name="nucleated" id="nucleated_not"
                                        value="0" {{ $product->nucleated == '0' ? 'checked' : '' }}>
                                    <label
                                        class="btn btn-outline-danger rounded-0 border-2 {{ $product->nucleated == '0' ? 'active' : '' }}"
                                        for="nucleated_not">No</label>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control rounded-0 border-2 border-dark">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="col-3 mb-3">
                                <label for="price" class="form-label">Price (for admin) <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="price" id="price"
                                    value="{{ old('price', $product->price) }}"
                                    class="form-control rounded-0 border-2 border-dark" required>
                            </div>
                            <div class="col-3 mb-3">
                                <label for="stock_quantity" class="form-label">Stock Quantity <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="stock_quantity" id="stock_quantity"
                                    value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                    class="form-control rounded-0 border-2 border-dark" required>
                            </div>
                            <div class="col-3 mb-3">
                                <label for="photo" class="form-label">Product Photo <span
                                        class="text-warning font-monospace" style="font-size: 8pt">2Mb size
                                        max</span></label>
                                <input type="file" name="photo" id="photo"
                                    value="{{ old('photo', $product->photo) }}"
                                    class="form-control rounded-0 border-2 border-dark">
                            </div>
                            <div class="col-3 mb-3">
                                <label for="is_hidden" class="form-label">Hidden<span
                                        class="text-danger">*</span></label>
                                <br>
                                <div class="btn-group" role="group" aria-label="Visibility">
                                    <input type="radio" class="btn-check" name="is_hidden" id="hidden"
                                        value="1" {{ $product->is_hidden == '1' ? 'checked' : '' }}>
                                    <label
                                        class="btn btn-outline-danger me-3 rounded-0 border-2 {{ $product->is_hidden == '1' ? 'active' : '' }}"
                                        for="hidden">Hidden</label>

                                    <input type="radio" class="btn-check" name="is_hidden" id="visible"
                                        value="0" {{ $product->is_hidden == '0' ? 'checked' : '' }}>
                                    <label
                                        class="btn btn-outline-primary rounded-0 border-2 {{ $product->is_hidden == '0' ? 'active' : '' }}"
                                        for="visible">Visible</label>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-outline-success rounded-0 border-2 fw-semibold"
                                style="padding: 4px 80px"><i class="bi bi-node-plus"></i> Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col ms-3">
                <div class="row mt-4 mb-2">
                    <h2>Preview</h2>
                </div>
                <div class="row">
                    <div class="card rounded-0 border-0 border-dark" style="width: 15rem">
                        @if ($product->photo)
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" target="_blank"><img
                                    src="{{ asset('storage/' . $product->photo) }}" class="card-img-top rounded-0"
                                    alt="{{ $product->name }}"></a>
                        @else
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" target="_blank"><img
                                    src="{{ asset('placeholder.jpg') }}" class="card-img-top" alt="Placeholder"></a>
                        @endif
                        <div class="card-body" style="background-color: #0C141C">
                            <a href="{{ route('product.show', ['id' => $product->id]) }}" target="_blank"
                                class="link-light text-decoration-none fw-semibold fs-5">{{ $product->name }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
