<div class="container-fluid py-3">
    <div class="container d-none d-md-block">
        <div class="row">
            <div class="col-1">
                <a href="/" class="fw-semibold fs-2 text-decoration-none link-light"><img
                        src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo" style="width: 150px"></a>
            </div>
            <div class="col-10">
                <div class="text-center mt-1">
                    <a href="{{ route('categories.index') }}"
                        class="btn btn-outline-light rounded-0 fw-semibold mx-2 border-2">Products</a>
                    <a href="{{ route('about') }}" class="btn btn-outline-light rounded-0 fw-semibold border-2">About</a>
                    <a href="{{ route('contacts') }}" class="btn btn-outline-light rounded-0 fw-semibold ms-2 border-2">Contacts</a>
                    <a href="{{ route('cart.index') }}"
                        class="float-end btn btn-outline-light rounded-0 fw-semibold mx-2 border-2"><i class="bi bi-bag"></i>
                        @php
                            $cartItemCount = session('cartItemCount', 0);
                        @endphp
                        @if ($cartItemCount > 0)
                            <span class="text-danger">{{ $cartItemCount }}</span>
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-block d-md-none">
        <nav class="navbar bg-dark fixed-top">
            <div class="container-fluid">
                <a href="/" class="fw-semibold fs-2 text-decoration-none link-light"><img
                        src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo" style="width: 150px"></a>
                <button class="navbar-toggler border-light" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="text-light"><i class="bi bi-cup-straw"></i></span>
                </button>
                <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <a href="/" class="fw-semibold fs-2 text-decoration-none link-light"><img
                                src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo" style="width: 150px"></a>
                        <button type="button" class="text-light btn btn-outline-light border-0" data-bs-dismiss="offcanvas"
                            aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                    <div class="offcanvas-body bg-dark">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link fs-5 link-light" aria-current="page"
                                    href="{{ route('categories.index') }}">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-5 link-light" href="{{ route('about') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-5 link-light" href="{{ route('contacts') }}">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('storage/catalogue/Merlon Catalogue.pdf') }}" class="nav-link fs-5 link-light" download><i class="bi bi-file-earmark-arrow-down"></i> Drinkware catalogue (stock products)</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart.index') }}" class="nav-link fs-5 link-light"><i class="bi bi-bag"></i>
                                    @php
                                        $cartItemCount = session('cartItemCount', 0);
                                    @endphp
                                    @if ($cartItemCount > 0)
                                        <span class="text-danger">{{ $cartItemCount }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
