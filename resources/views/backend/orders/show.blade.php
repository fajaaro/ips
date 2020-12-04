@extends('backend.layouts.app')

@section('content')

	@include('flash')

	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Order Details</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <p><span class="font-weight-bold">ID:</span> {{ $order->id }}</p>
                            <p><span class="font-weight-bold">Invoice Number:</span> {{ $order->invoice_number }}</p>
                            <p><span class="font-weight-bold">Customer Name:</span> {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                            <p><span class="font-weight-bold">Type:</span> {{ $order->course_id ? 'Single (' . $order->course->name . ')' : 'Bundle (' . $order->bundle->name . ')' }}</p>
                            <p><span class="font-weight-bold">Total Price:</span> {{ formatRupiah($order->total_price) }}</p>
                            <p><span class="font-weight-bold">Payment Status:</span> {{ ucfirst($order->payment_status) }} {{ $order->payment_status == 'paid' ? '(' . formatDate($order->paid_at) . ')' : '' }}</p>
                            <p><span class="font-weight-bold">Order Date:</span> {{ formatDate($order->created_at) }}</p>

                            @if ($order->courseUser)
                                <p><span class="font-weight-bold">Expired At:</span> {{ formatDate($order->courseUser->expired_at) }}</p>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('backend.orders.edit', ['id' => $order->id]) }}">
	                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                    </a>
                    <a href="{{ route('backend.orders.index') }}">
                        <button type="button" class="btn btn-outline-secondary btn-sm float-right"><i class="fas fa-arrow-left"></i> Go Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
