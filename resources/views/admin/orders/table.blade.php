@extends('index')

@section('siteTitle', 'Merlon | Orders')

@section('content')
    <header>
        @include('admin.header')
    </header>
    <main>
        <div class="container-fluid">
            <div class="row my-3 p-3">
                <div class="col">
                    <h1 class="ms-5">All Orders</h1>
                </div>
                <div class="col">
                    <form action="{{ route('admin.search') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="search_query" class="form-control rounded-0 border-2 border-dark"
                                placeholder="Search by name, company name, VAT or order id">
                            <button type="submit" class="btn btn-outline-dark rounded-0 border-2 ms-3"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="col">
                    <!-- filter by status -->
                </div>
            </div>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Last Name</th>
                        <th>Company Name</th>
                        <th>Status</th>
                        <th>Total Cost</th>
                        <th>Items</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedOrders as $orderGroupId => $orders)
                        @php
                            $ordersCollection = collect($orders); // Convert the array of orders into a collection

                            $totalProducts = $ordersCollection->sum('quantity');
                            $firstOrder = $ordersCollection->first();
                            $orderDate = $firstOrder->created_at->format('m-d H:i');
                            $totalCost = $ordersCollection->sum(function ($order) {
                                return $order->quantity * $order->product->price;
                            });
                        @endphp
                        <tr>
                            <td><a
                                    href="{{ route('admin.orderDetails', ['orderGroupId' => $orderGroupId]) }}">{{ $orderGroupId }}</a>
                            </td>
                            <td>{{ $orderDate }}</td>
                            <td>{{ $firstOrder->last_name }}</td>
                            <td>{{ $firstOrder->company_name }}</td>
                            <td class="fw-semibold
                                    @if ($firstOrder->status === 'unfulfilled') text-warning
                                    @elseif ($firstOrder->status === 'estimate sent') text-primary
                                    @elseif ($firstOrder->status === 'fulfilled') text-success
                                    @else text-danger @endif
                                    text-uppercase">
                                {{ $firstOrder->status }}
                            </td>
                            <td>€ {{ $totalCost }}</td>
                            <td>{{ $totalProducts }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
