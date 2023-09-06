@extends('index')

@section('siteTitle', 'Merlon | Create Subcategory')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <div class="container" style="margin-top: 7rem">
        <form action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card rounded-0 border-0 p-3">
                <div class="row p-3">
                    <div class="col">
                        <h1>Create Subcategory</h1>
                    </div>
                    <div class="col">
                        <a href="{{ route('admin.subcategories.index') }}"
                            class="btn btn-outline-light rounded-0 border-2 float-end"><i class="bi bi-arrow-left"></i>
                            Go back</a>
                    </div>
                </div>
                <hr class="border-light border-2">
                <div class="mb-3">
                    <label for="title" class="form-label">Subcategory Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-0 border-2 border-dark" id="title"
                        name="title" required>
                </div>
                <div class="mb-3">
                    <label for="subcategory_photo" class="form-label">Subcategory Photo <span class="text-danger">*</span> <span
                            class="text-warning font-monospace" style="font-size: 8pt">2Mb size max</span></label>
                    <input type="file" class="form-control rounded-0 border-2 border-dark" id="subcategory_photo"
                            name="subcategory_photo" required>
                </div>
                <div class="mb-3">
                        <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-select rounded-0 border-2 border-dark"
                            >
                            <option value="" disabled selected>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-primary rounded-0 fw-semibold border-2"
                        style="width: 350px">Create Subcategory</button>
                </div>
            </div>
        </form>
    </div>
@endsection
