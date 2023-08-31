@extends('index')

@section('siteTitle', 'Merlon | Caterory edit')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <div class="container" style="margin-top: 15svh">
        <form action="{{ route('categories.update', ['category' => $category]) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card rounded-0 border-0">
                <div class="row p-3">
                    <div class="col">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col">
                        <a href="{{ route('admin.categories.index') }}"
                            class="btn btn-outline-dark rounded-0 border-2 float-end"><i class="bi bi-arrow-left"></i>
                            Go back</a>
                    </div>
                    <hr class="border-light border-2">
                </div>
                <div class="row p-3">
                    <div class="col mb-3">
                        <label for="title" class="form-label">Category Title</label>
                        <input type="text" class="form-control rounded-0 border-2 border-dark" id="title"
                            name="title" value="{{ $category->title }}" required>
                    </div>


                    <div class="col mb-3">
                        <label for="is_hidden" class="form-label">Hidden</label>
                        <br>
                        <div class="btn-group" role="group" aria-label="Visibility">
                            <input type="radio" class="btn-check" name="is_hidden" id="hidden" value="1"
                                {{ $category->is_hidden == '1' ? 'checked' : '' }}>
                            <label
                                class="btn btn-outline-danger me-3 rounded-0 border-2 {{ $category->is_hidden == '1' ? 'active' : '' }}"
                                for="hidden">Hidden</label>

                            <input type="radio" class="btn-check" name="is_hidden" id="visible" value="0"
                                {{ $category->is_hidden == '0' ? 'checked' : '' }}>
                            <label
                                class="btn btn-outline-primary rounded-0 border-2 {{ $category->is_hidden == '0' ? 'active' : '' }}"
                                for="visible">Visible</label>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-success rounded-0 border-2 fw-semibold"
                            style="padding: 4px 80px"><i class="bi bi-node-plus"></i> Update Category</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
