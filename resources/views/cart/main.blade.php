<div class="container">
    <div class="row">
        <div class="col">
            <h1>Cart</h1>

            @if (empty($cart))
                <p>Your cart is empty.</p>
            @else
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-2">Product Code</div>
                    <div class="col-3">Product Name</div>
                    <div class="col-3">Quantity</div>
                    <div class="col-2 d-none d-md-block">Actions</div>
                </div>
                <hr>
                @foreach ($cart as $productId => $quantity)
                    @php
                        $product = \App\Models\Product::find($productId);
                    @endphp
                    @if ($product)
                        <div class="row">
                            <div class="col-2">
                                <img src="{{ asset('storage/' . $product->photo) }}" style="width: 50px"
                                    class="card-img-top rounded-0" alt="{{ $product->name }}">
                            </div>
                            <div class="col-2">{{ $product->product_code }}</div>
                            <div class="col-3">{{ $product->name }}</div>
                            <div class="col-5 col-md-3">
                                <form action="{{ route('cart.updateQuantity', ['productId' => $productId]) }}"
                                    method="POST" class="d-flex align-items-center">
                                    @csrf
                                    <input type="number" name="quantity"
                                        class="form-control rounded-0 border-2 border-dark rounded-0 border-2 border-dark" style="width:60px"
                                        value="{{ $quantity }}" min="1">
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-dark rounded-0 border-2 fw-semibold ms-2">Update</button>
                                </form>
                                <form action="{{ route('cart.remove', ['productId' => $productId]) }}" method="POST"
                                    class="d-inline d-block d-md-none">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger rounded-0 border-2 fw-semibold mt-4 ms-1 px-4"><i
                                            class="bi bi-x"></i> Remove</button>
                                </form>
                            </div>
                            <div class="col-2">
                                <form action="{{ route('cart.remove', ['productId' => $productId]) }}" method="POST"
                                    class="d-inline d-none d-md-block">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger rounded-0 border-2 fw-semibold mt-1"><i
                                            class="bi bi-x"></i> Remove</button>
                                </form>
                            </div>
                        </div>
                        <hr>
                    @endif
                @endforeach


                <form action="{{ route('cart.placeOrder') }}" method="POST">
                    @method('POST')
                    @csrf

                    @foreach ($cart as $productId => $quantity)
                        <input type="hidden" name="cart[{{ $productId }}]" value="{{ $productId }}">
                        <input type="hidden" name="cart[{{ $quantity }}]" value="{{ $quantity }}">
                    @endforeach
                    <div class="row">
                        <div class="col-4 mb-3">
                            <label for="first_name" class="form-label">First Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="first_name" name="first_name"
                                value="{{ old('first_name') }}" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="last_name" class="form-label">Last Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="last_name" name="last_name"
                                value="{{ old('last_name') }}" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="company_name" class="form-label">Company</label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="company_name" name="company_name"
                                value="{{ old('company_name') }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="vat" class="form-label">VAT</label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="vat" name="vat"
                                value="{{ old('vat') }}">
                        </div>
                        <div class="col-4 mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="address" name="address"
                                value="{{ old('address') }}" required>
                        </div>
                        <div class="col-4 mb-3">
                            <label for="zip" class="form-label">zip <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="zip" name="zip"
                                value="{{ old('zip') }}" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-0 border-2 border-dark" id="phone" name="phone"
                                value="{{ old('phone') }}" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="client_email" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control rounded-0 border-2 border-dark" id="client_email" name="client_email"
                                value="{{ old('client_email') }}" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="comment" class="form-label">Comment</label>
                            <textarea class="form-control rounded-0 border-2 border-dark" id="comment" rows="5" name="comment">{{ old('comment') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-success border-2 rounded-0 fw-semibold"><i class="bi bi-envelope-open"></i> Request Quote</button>
                </form>
            @endif
        </div>
    </div>
</div>
