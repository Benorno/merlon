<div class="container-fluid bg-black">
    <div class="container p-3">
        <div class="row">
            <div class="col-2">
                <a href="/admin/orders" class="fw-semibold fs-2 text-decoration-none link-light"><img
                        src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo" style="width: 150px"></a>
                <p class="ms-5 text-light">Admin Panel</p>
            </div>
            <div class="col-8 text-center mt-3">
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-light rounded-0 border-2 fw-semibold">Order Requests</a>
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-light rounded-0 border-2 fw-semibold mx-2">Products</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-light rounded-0 border-2 fw-semibold">Categories</a>
            </div>
            <div class="col-2 mt-3">
                <div class="dropdown">
                    <button class="btn btn-outline-light rounded-0 border-2 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ auth()->user()->username }}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.help') }}">Help</a></li>
                        <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    document.querySelector('.dropdown-item[href="{{ route('logout') }}"]').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
</script>
