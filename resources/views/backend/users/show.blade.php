@extends('backend.layouts.app')

@section('content')

	@include('flash')

	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">User Details</div>

                <div class="card-body">
                    @if ($user->image)
                        <img src="{{ Storage::url($user->image->url) }}" class="w-100 mb-3">
                    @else 
                        <img src="{{ Storage::url('user-avatars/default.png') }}" class="w-100 mb-3">
                    @endif

                    <div class="row">
                        <div class="col">
                            <p><span class="font-weight-bold">ID:</span> {{ $user->id }}</p>
                            <p><span class="font-weight-bold">Full Name:</span> {{ $user->getFullName() }}</p>
                            <p><span class="font-weight-bold">Role:</span> {{ ucfirst($user->role->name) }}</p>
                            <p><span class="font-weight-bold">Email:</span> {{ $user->email }} {!! $user->email_verified_at ? '<span class="font-weight-bold">(Verified)</span>' : '' !!}</p>
                            <p><span class="font-weight-bold">Phone Number:</span> {{ $user->phone_number }}</p>
                            <p><span class="font-weight-bold">Registered At:</span> {{ formatDate($user->created_at) }}</p>
                            <p><span class="font-weight-bold">API Token:</span> {{ $user->api_token }}</p>

                            @if ($user->userAddress)
                                <hr>

                                <p><span class="font-weight-bold">Address:</span> {{ $user->userAddress->address }}</p>
                                <p><span class="font-weight-bold">Subdistrict:</span> {{ $user->userAddress->subdistrict->kelurahan }}</p>
                                <p><span class="font-weight-bold">District:</span> {{ $user->userAddress->subdistrict->kecamatan }}</p>
                                <p><span class="font-weight-bold">City:</span> {{ $user->userAddress->subdistrict->city }}</p>                                
                                <p><span class="font-weight-bold">Province:</span> {{ $user->userAddress->subdistrict->province->name }}</p>                                
                            @endif

                            <hr>
                            <p><span class="font-weight-bold">Total Orders:</span> {{ $user->orders->count() }} (Paid {{ $user->paidOrders()->count() }}, Unpaid {{ $user->unpaidOrders()->count() }})</p>
                            <p><span class="font-weight-bold">Total Active Courses:</span> {{ $user->activeCourses()->count() }}</p>

                        </div>
                    </div>

                    <a href="{{ route('backend.users.edit', ['id' => $user->id]) }}">
	                    <button type="button" class="btn btn-warning btn-sm">Edit</button>
                    </a>
                    <a href="{{ url()->previous() }}">
                        <button type="button" class="btn btn-outline-secondary btn-sm float-right"><i class="fas fa-arrow-left"></i> Go Back</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
