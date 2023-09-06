@extends('index')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <div class="container" style="margin-top: 15svh">
        <div class="card rounded-0 border-0">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-3">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col">
                        <h2>Create Product Card</h2>
                    </div>
                    <div class="col mb-3">
                        <a href="{{ route('admin.products.index') }}"
                            class="btn btn-outline-dark rounded-0 border-2 float-end"><i class="bi bi-arrow-left"></i> Go
                            back</a>
                    </div>
                    <hr class="border-light border-2">
                    <div class="col-4 mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control rounded-0 border-2 border-dark" required>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="product_code" class="form-label">Product Code <span class="text-danger">*</span></label>
                        <input type="text" name="product_code" id="product_code"
                            class="form-control rounded-0 border-2 border-dark" required>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="subcategory_id" class="form-label">Subcategory <span class="text-danger">*</span></label>
                        <select name="subcategory_id" id="subcategory_id" class="form-select rounded-0 border-2 border-dark"
                            >
                            <option value="" disabled selected>Select a subcategory</option>
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-3 mb-3">
                        <label for="weight" class="form-label">Weight (g)</label>
                        <input type="text" name="weight" id="weight"
                            class="form-control rounded-0 border-2 border-dark">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="top_width" class="form-label">Top Width (mm)</label>
                        <input type="text" name="top_width" id="top_width"
                            class="form-control rounded-0 border-2 border-dark">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="bottom_width" class="form-label">Bottom Width (mm)</label>
                        <input type="text" name="bottom_width" id="bottom_width"
                            class="form-control rounded-0 border-2 border-dark">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="height" class="form-label">Overall Height (mm)</label>
                        <input type="text" name="height" id="height"
                            class="form-control rounded-0 border-2 border-dark">
                    </div>

                    <div class="col-3 mb-3">
                        <label for="origin" class="form-label">Origin</label>
                        <input type="text" name="origin" id="origin"
                            class="form-control rounded-0 border-2 border-dark" value="UK">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="material" class="form-label">Material</label>
                        <input type="text" name="material" id="material"
                            class="form-control rounded-0 border-2 border-dark" value="Polycarbonate">
                    </div>
                    <div class="col-2 mb-3">
                        <label for="quantity_carton" class="form-label">Quantity Per Carton</label>
                        <input type="text" name="quantity_carton" id="quantity_carton"
                            class="form-control rounded-0 border-2 border-dark">
                    </div>
                    <div class="col-2 mb-3">
                        <label for="stockable" class="form-label">Stockable</label>
                        <select name="stockable" id="stockable" class="form-select rounded-0 border-2 border-dark"
                            required>
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-2 mb-3">
                        <label for="nucleated" class="form-label">Nucleated</label>
                        <select name="nucleated" id="nucleated" class="form-select rounded-0 border-2 border-dark"
                            required>
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control rounded-0 border-2 border-dark">
                        </textarea>
                    </div>

                    <div class="col-4 mb-3">
                        <label for="price" class="form-label">Price (for admin) <span
                                class="text-danger">*</span></label>
                        <input type="text" name="price" id="price"
                            class="form-control rounded-0 border-2 border-dark" required>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="stock_quantity" class="form-label">Stock Quantity <span
                                class="text-danger">*</span></label>
                        <input type="text" name="stock_quantity" id="stock_quantity"
                            class="form-control rounded-0 border-2 border-dark" value="99" required>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="photo" class="form-label">Product Photo <span class="text-warning font-monospace"
                                style="font-size: 8pt">2Mb size max</span></label>
                        <input type="file" name="photo" id="photo"
                            class="form-control rounded-0 border-2 border-dark">
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-outline-success rounded-0 border-2 fw-semibold me-2"
                        style="padding: 4px 80px">
                        <i class="bi bi-plus-lg"></i> Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
