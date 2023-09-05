<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">
                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Update Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="username" name="username"
                                value="{{ old('username', $user->username) }}" required>
                        </div>

                        <button type="submit" class="btn btn-sm btn-outline-success rounded-0 border-2 fw-semibold"><i
                                class="bi bi-node-plus"></i> Update
                        </button>
                    </form>

                    <hr>

                    <form method="POST" action="{{ route('profile.updatePassword') }}">
                        @csrf
                        @method('PUT')

                        <!-- Update Password -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control rounded-0 border-2 border-dark" id="current_password" name="current_password"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control rounded-0 border-2 border-dark" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control rounded-0 border-2 border-dark" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-sm btn-outline-success rounded-0 border-2 fw-semibold"><i
                                class="bi bi-node-plus"></i> Update
                        </button>
                    </form>

                    <hr>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('DELETE')

                        <!-- Delete Account -->
                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-0 border-2 fw-semibold"
                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                            <i class="bi bi-trash3"></i> Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
