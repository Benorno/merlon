@extends('index')

@section('siteTitle', 'Merlon | Subcaterory edit')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <div class="container" style="margin-top: 15svh">
        <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card rounded-0 border-0">
                <div class="row p-3">
                    <div class="col">
                        <h1>Edit Subcategory</h1>
                    </div>
                    <div class="col">
                        <a href="{{ route('admin.subcategories.index') }}"
                            class="btn btn-outline-dark rounded-0 border-2 float-end"><i class="bi bi-arrow-left"></i>
                            Go back</a>
                    </div>
                    <hr class="border-light border-2">
                </div>
                <div class="row p-3">
                    <div class="col-6 mb-3">
                        <label for="title" class="form-label">Category Title</label>
                        <input type="text" class="form-control rounded-0 border-2 border-dark" id="title"
                            name="title" value="{{ $subcategory->title }}" required>
                    </div>

                    <div class="col-6 mb-3 text-center">
                        <label for="is_hidden" class="form-label">Hidden</label>
                        <br>
                        <div class="btn-group" role="group" aria-label="Visibility">
                            <input type="radio" class="btn-check" name="is_hidden" id="hidden" value="1"
                                {{ $subcategory->is_hidden == '1' ? 'checked' : '' }}>
                            <label
                                class="btn btn-outline-danger px-5 me-3 rounded-0 border-2 {{ $subcategory->is_hidden == '1' ? 'active' : '' }}"
                                for="hidden">Hidden</label>

                            <input type="radio" class="btn-check" name="is_hidden" id="visible" value="0"
                                {{ $subcategory->is_hidden == '0' ? 'checked' : '' }}>
                            <label
                                class="btn btn-outline-primary px-5 rounded-0 border-2 {{ $subcategory->is_hidden == '0' ? 'active' : '' }}"
                                for="visible">Visible</label>
                        </div>
                    </div>

                    <div class="col-6 mb-3">
                        <label for="subcategory_photo" class="form-label">Subcategory Photo <span
                                class="text-warning font-monospace" style="font-size: 8pt">2Mb size max</span></label>
                        <input type="file" name="subcategory_photo" id="subcategory_photo"
                            class="form-control rounded-0 border-2 border-dark">
                    </div>

                    <div class="col-6 mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-select rounded-0 border-2 border-dark" required>
                                    <option value="" disabled selected>Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-success rounded-0 border-2 fw-semibold"
                            style="padding: 4px 80px"><i class="bi bi-node-plus"></i> Update Subcategory</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
