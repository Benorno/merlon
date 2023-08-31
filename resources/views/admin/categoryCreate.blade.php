@extends('index')

@section('siteTitle', 'Merlon | Create Category')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <div class="container" style="margin-top: 7rem">
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card rounded-0 border-0 p-3">
                <div class="row p-3">
                    <div class="col">
                        <h1>Create Category</h1>
                    </div>
                    <div class="col">
                        <a href="{{ route('admin.categories.index') }}"
                            class="btn btn-outline-light rounded-0 border-2 float-end"><i class="bi bi-arrow-left"></i>
                            Go back</a>
                    </div>
                </div>
                <hr class="border-light border-2">
                <div class="mb-3">
                    <label for="category_title" class="form-label">Category Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-0 border-2 border-dark" id="category_title"
                        name="category_title" required>
                </div>
                <div class="mb-3">
                    <label for="category_photo" class="form-label">Category Photo <span class="text-danger">*</span> <span
                            class="text-warning font-monospace" style="font-size: 8pt">2Mb size max</span></label>
                    <input type="file" class="form-control rounded-0 border-2 border-dark" id="category_photo"
                            name="category_photo" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-primary rounded-0 fw-semibold border-2"
                        style="width: 350px">Create Category</button>
                </div>
            </div>
        </form>
    </div>
@endsection
