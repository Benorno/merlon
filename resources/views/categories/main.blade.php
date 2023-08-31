<header class="fixed-top" style="background-color: #131617">
    @include('components.header')
</header>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Categories</h1>
        </div>
        <div class="col">
            <div class="float-end">
                <a href="{{ asset('storage/catalogue/Merlon Catalogue.pdf') }}" class="btn btn-sm btn-outline-dark rounded-0 border-2 fw-semibold" download><i class="bi bi-file-earmark-arrow-down"></i> Drinkware catalogue (stock products)</a>
            </div>
        </div>
    </div>
    <div class="row ms-3 ms-md-1 ms-xxl-0">
        @foreach ($categories as $category)
        @if (!$category->is_hidden)
            <div class="col-xl-4 col-lg-4 col-md-6 col-xxl-3 col-12 mb-5 ">
                <div class="card rounded-0 border-0 border-dark" style="width: 18rem">
                    @if ($category->category_photo)
                        <a href="{{ route('categories.show', ['category' => $category]) }}"><img src="{{ asset('storage/' . $category->category_photo) }}" class="card-img-top rounded-0" alt="{{ $category->title }}"></a>
                    @else
                        <a href="{{ route('categories.show', ['category' => $category]) }}"><img src="{{ asset('storage/placeholder.png') }}" class="card-img-top" alt="Placeholder"></a>
                    @endif
                    <div class="card-body" style="background-color: #0C141C">
                        <a href="{{ route('categories.show', ['category' => $category]) }}" class="link-light link-underline link-underline-opacity-0 fw-semibold fs-5">{{ $category->title }}</a>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    </div>
</div>

