@extends('index')

@section('siteTitle', 'Merlon | Subcategories')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <main class="container-fluid">
        <div class="row my-3 p-3">
            <div class="col">
                <h1 class="ms-5">Subcategory Listing</h1>
            </div>
            <div class="col">
                <form action="{{ route('admin.subcategories.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control rounded-0 border-2 border-dark"
                            placeholder="Search by subcategory name">
                        <button type="submit" class="btn btn-outline-dark rounded-0 border-2 ms-3"><i
                                class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
            <div class="col">
                <div class="float-end">
                    <a href="{{ route('subcategories.create') }}"
                        class="btn btn-outline-dark rounded-0 border-2 fw-semibold">Create Subcategory</a>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Parent</th>
                    <th>Is Hidden</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategories as $subcategory)
                    <tr>
                        <td>{{ $subcategory->id }}</td>
                        <th><a href="{{ route('subcategories.edit', $subcategory->id) }}"><img
                                    src="{{ asset('storage/' . $subcategory->subcategory_photo) }}"
                                    class="card-img-top rounded-0" alt="{{ $subcategory->title }}" style="width: 25px"></a>
                        </th>
                        <td>{{ $subcategory->title }}</td>
                        <td>
                            @if ($subcategory->categories)
                                {{ $subcategory->categories->title }}
                            @else
                                <span class="text-danger text-uppercase fw-semibold">not assigned</span>
                            @endif
                        </td>

                        <td>
                            @if ($subcategory->is_hidden)
                                <span class="text-danger"><i class="bi bi-eye-slash"></i> Hidden</span>
                            @else
                                <span class="text-success"><i class="bi bi-eye"></i> Visible</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('subcategories.edit', $subcategory->id) }}"
                                class="btn btn-sm btn-outline-primary rounded-pill border-0"><i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill border-0"
                                    onclick="return confirm('Are you sure you want to delete this subcategory?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
