@extends('frontend.layouts.app', ['pageTitle' => 'Indonesia Patisserie School'])

@push('styles')
	<link rel="stylesheet" href="{{ asset('frontend/style/gateway.css') }}">
@endpush

@section('content')
	<div class="text-center ips-login-logo">
	    <img class="" src="{{ asset('frontend/assets/logo.png') }}" alt="Logo">
	    <h1 class="mt-3" style="color: #ffffff;">Virtual Class with Master Aing</h1>
	</div>
	<div class="login-form text-center mr-auto ml-auto">
	    <form method="POST" action="{{ route('login') }}">
	    	@csrf

	        <h1 class="text-lg-center text-md-center text-sm-left font-weight-normal mb-5">Sign In to Your Account</h1>
	        <div class="form-group text-left">
	            <label for="email" class="font-weight-bold">Email address</label>
	            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" required autocomplete="email" autofocus placeholder="Enter email">

	            @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
	        </div>
	        <div class="form-group text-left">
	            <label for="password" class="font-weight-bold">Password</label>
	            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required placeholder="Password">

	            @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
	        </div>
	        <div class="form-group text-left">
	            <a href="">Forgot Password?</a>
	        </div>
	        <button type="submit" class="btn btn-primary d-block mt-3">SIGN IN</button>
	        <hr>
	        <a href="" class="text-center text-muted font-weight-light">You don’t have an account yet ? Contact Us</a>
	    </form>
	</div>
	<footer class="text-center">
	    &copy;Indonesia Patisserie School
	</footer>
@endsection