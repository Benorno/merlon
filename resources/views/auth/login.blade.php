@extends('index')

@section('content')
<div class="container">
    <!-- Display the alert message if it exists -->
    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <div class="row d-flex justify-content-center" style="margin-top: 20%">
        <div class="col-6">
            <form class="p-4 rounded-4 text-dark" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="col-12 text-center mb-4">
                    <a href="/" class="text-decoration-none text-light fw-semibold fs-4"><img
                            src="https://i.postimg.cc/9FPsYCnB/logo.png"
                            alt="logo" style="width: 170px; filter: invert(100%);"></a>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control rounded-0 border-2 border-dark" id="username" name="username" required>
                    <!-- Add name="username" attribute above -->
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control rounded-0 border-2 border-dark" id="password" name="password" required>
                    <!-- Add name="password" attribute above -->
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-dark rounded-0 border-2 fw-semibold mt-3" style="padding: 5px 80px">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
