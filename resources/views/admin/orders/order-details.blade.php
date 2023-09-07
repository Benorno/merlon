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
                padding-bottom: 72px;
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
    <main style="margin-bottom: 11svh">
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
                        <img src="https://i.postimg.cc/9FPsYCnB/logo.png" alt="logo"
                            style="width: 150px; filter: invert(100%)">
                    </div>
                </div>
                <div class="col d-none d-md-block">
                    <h1 class="ms-5">Order - {{ $orderGroupId }}</h1>
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
                <div class="col">
                    <div class="ms-5 my-5 d-none d-md-block" style="width: 20rem">
                        <div>
                            <h3 class="fw-seemibold">Clients Info</h3>
                            <hr>
                            <p><span class="fw-semibold">Name:</span> {{ $firstOrder->first_name }}
                                {{ $firstOrder->last_name }}</p>
                            <p><span class="fw-semibold">Company:</span> {{ $firstOrder->company_name }}</p>
                            <p><span class="fw-semibold">VAT:</span> {{ $firstOrder->vat }}</p>
                            <p><span class="fw-semibold">Address:</span> {{ $firstOrder->address }},
                                {{ $firstOrder->zip }}
                            </p>
                            <p><span class="fw-semibold">Phone:</span> {{ $firstOrder->phone }}</p>
                            <p><span class="fw-semibold">Email:</span> <a href="mailto:{{ $firstOrder->client_email }}"
                                    class="link-dark">{{ $firstOrder->client_email }}</a></p>
                            <p><span class="fw-semibold">Comment:</span> {{ $firstOrder->comment }}</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-5 d-none d-md-block">
                        <h3>Status</h3>
                        <br>
                        <p
                            class="fw-semibold fs-5 text-uppercase
                                @if ($firstOrder->status === 'unfulfilled') text-warning
                                @elseif ($firstOrder->status === 'estimate sent') text-primary
                                @elseif ($firstOrder->status === 'fulfilled') text-success
                                @else text-danger @endif">
                            {{ $firstOrder->status }}
                        </p>

                    </div>
                </div>
                <div class="col">
                    <div class="d-none d-md-block mt-5">
                        <h3>Functions</h3>
                        <br>
                        {{-- <a href="#" class="btn btn-outline-secondary rounded-0 border-2 fw-semibold">Edit Order</a> --}}
                        <br>
                        <button class="btn btn-outline-primary my-3 rounded-0 border-2 fw-semibold" data-bs-toggle="modal"
                            data-bs-target="#ModalStatus">Change
                            Status</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="container-fluid">
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
                                                    alt="{{ $order->product->name }}" class="d-none d-md-block"
                                                    style="width: 50px;">
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

    <div class="modal fade" id="ModalStatus" tabindex="-1" aria-labelledby="ModalStatusLable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalStatusLable">Change Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST"
                        action="{{ route('admin.orders.updateStatus', ['orderId' => $order->order_id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-4">
                            <label for="status" class="mb-2">Change Status:</label>
                            <select class="form-control rounded-0 border-2 border-dark" id="status" name="status">
                                <option value="unfulfilled">Unfulfilled</option>
                                <option value="estimate sent">Estimate Sent</option>
                                <option value="fulfilled">Fulfilled</option>
                                <option value="voided">Voided</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-primary rounded-0 border-2 fw-semibold">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
