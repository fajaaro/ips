@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/style/main.css') }}">
@endpush

@push('fonts')
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
@endpush

@section('navbar')
    @include('frontend.partials.navbar')
@endsection

@section('content')
	<div class="container-fluid checkout-wrapper text-center">
	    <h1 style="color: #3252DF;">Transaction Succes</h1>
	    <h5 class="text-muted mt-3">Invoice Number: <span id="invoice-number">{{ $order->invoice_number }}</span></h5>
        <h5 class="text-muted">Product: {{ $order->course->name ?? $order->bundle_name . ' (Bundle)' }}</h5>         
        <h5 class="text-muted">Total Price: {{ formatRupiah($order->total_price) }}</h5>
	    <img src="{{ asset('frontend/assets/checkout.png') }}" alt="Checkout.png" class="img-fluid mt-3">
	    <p class="text-muted mt-2">We will contact you soon through whatsapp, kindly screenshoot your transaction as a prove.</p>
	</div>
@endsection

@section('footer')
    @include('frontend.partials.footer', ['bgColor' => '#ffffff', 'useHr' => true, 'useLogo' => true, 'columnSize' => 'col-lg-3'])
@endsection