@extends('index')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center" style="margin-top: 20%">
        <div class="col-6">
            <form class="bg-dark p-4 rounded-4 text-light" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="col-12 text-center mb-4">
                    <a href="/" class="text-decoration-none text-light fw-semibold fs-4"><img
                            src="https://i.postimg.cc/9FPsYCnB/logo.png"
                            alt="logo" style="width: 170px"></a>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-light rounded-0 border-2 fw-semibold mt-3" style="padding: 5px 80px">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
