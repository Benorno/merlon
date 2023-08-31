@extends('index')

@section('siteTitle', 'Merlon | Orders')

@section('content')
<style>
    @page {
	size: auto;
	margin: 0;
}
@print {
	@page :footer {
		display: none
	}

	@page :header {
		display: none
	}
}
@media print {
	@page {
		margin-top: 0;
		margin-bottom: 0;
	}
	body {
		padding-top: 72px;
		padding-bottom: 72px ;
        -webkit-print-color-adjust: exact;
        -moz-print-color-adjust: exact;
        -ms-print-color-adjust: exact;
        print-color-adjust: exact;
	}
}

</style>
    <header class="d-none d-md-block">
        @include('admin.header')
    </header>
    <main>
        <div class="container-fluid">
            @php
                $firstOrder = $orders->first();
                $totalOrderCost = $orders->sum(function ($order) {
                    return $order->quantity * $order->product->price;
                });
            @endphp

            <div class="row my-3 p-3">
                <div class="col d-block d-md-none">
                    <div class="float-start">
                        <img
                        src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo" style="width: 150px">
                    </div>
                </div>
                <div class="col d-none d-md-block">
                    <h1 class="ms-5">Order - {{ $orderGroupId }}</h1>
                </div>
                <div class="col">
                    <div class="float-end mt-2 me-5 d-none d-md-block">
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-0 border-2 fw-semibold">Edit</a>
                        <a href="#"
                            class="btn btn-sm btn-outline-primary mx-2 rounded-0 border-2 fw-semibold">Status</a>
                        <a href="#" class="btn btn-sm btn-outline-danger rounded-0 border-2 fw-semibold">Void
                            Order</a>
                    </div>
                </div>
            </div>
            <div class="row d-block d-md-none">
                <h1 class="ms-5">Order - {{ $orderGroupId }}</h1>
            </div>
            <hr>
            <div class="container-fluid d-block d-md-none" style="margin-bottom: 5svh">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title fw-bold">Clients Info</h5>
                        <p><span class="fw-semibold">Name:</span> {{ $firstOrder->first_name }}
                                {{ $firstOrder->last_name }}</p>
                        <p><span class="fw-semibold">Company:</span> {{ $firstOrder->company_name }}</p>
                        <p><span class="fw-semibold">VAT:</span> {{ $firstOrder->vat }}</p>
                        <p><span class="fw-semibold">Address:</span> {{ $firstOrder->address }},
                                {{ $firstOrder->zip }}
                        </p>
                        <p><span class="fw-semibold">Phone:</span> {{ $firstOrder->phone }}</p>
                        <p><span class="fw-semibold">Email:</span> {{ $firstOrder->client_email }}</p>
                        <p><span class="fw-semibold">Comment:</span> {{ $firstOrder->comment }}</p>
                    </div>
                    <div class="col">
                        <h5 class="card-title fw-bold">Merlon</h5>
                        <p><span class="fw-semibold">Company:</span> Merlon, MB</p>
                        <p><span class="fw-semibold">City:</span> Klaipėda</p>
                        <p><span class="fw-semibold">Address:</span> Kretingos g. 71,
                                92305
                        </p>
                        <p><span class="fw-semibold">Phone:</span> +37066920732</p>
                        <p><span class="fw-semibold">Email:</span> info@merlon.lt</p>
                        <a href="https://www.merlon.lt">merlon.lt</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="card ms-5 mt-5 d-none d-md-block" style="width: 20rem">
                        <div class="card-body">
                            <h5 class="card-title">Clients Info</h5>
                            <hr>
                            <p><span class="fw-semibold">Name:</span> {{ $firstOrder->first_name }}
                                {{ $firstOrder->last_name }}</p>
                            <p><span class="fw-semibold">Company:</span> {{ $firstOrder->company_name }}</p>
                            <p><span class="fw-semibold">VAT:</span> {{ $firstOrder->vat }}</p>
                            <p><span class="fw-semibold">Address:</span> {{ $firstOrder->address }},
                                {{ $firstOrder->zip }}
                            </p>
                            <p><span class="fw-semibold">Phone:</span> {{ $firstOrder->phone }}</p>
                            <p><span class="fw-semibold">Email:</span> {{ $firstOrder->client_email }}</p>
                            <p><span class="fw-semibold">Comment:</span> {{ $firstOrder->comment }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="container">
                        <h2>Ordered Products</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="col-4">
                                            <div>
                                                <img src="{{ asset('storage/' . $order->product->photo) }}"
                                                    alt="{{ $order->product->name }}" class="d-none d-md-block" style="width: 50px;">
                                                <p>{{ $order->product->name }} ({{ $order->product->product_code }})</p>
                                            </div>
                                        </td>
                                        <td class="col-1">{{ $order->quantity }}</td>
                                        <td>€ {{ $order->product->price }}</td>
                                        <td>€ {{ $order->quantity * $order->product->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h2>Total Order Estimate: € {{ $totalOrderCost }}</h2>
                        <button onclick="window.print()"
                            class="btn btn-outline-dark rounded-0 border-2 fw-semibold d-none d-md-block">Print
                            Estimate</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
