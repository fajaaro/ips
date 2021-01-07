@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/style/main.css') }}">
    <style type="text/css">
        .box-title {
            height: 60px;
        }
        #btn-finished {
            background-color: #383485;
            border-color: #383485;
            position: absolute;
            float: right;
            right: 0;
            margin-right: 10px;
            margin-top: 10px;
        }
    </style>
@endpush

@push('fonts')
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
@endpush

@section('navbar')
    @include('frontend.partials.navbar')
@endsection

@section('content')
    <section class="container profile-dashboard">
        <div class="row">
            @include('flash')
        </div>
        <div class="row">
            <div class="d-flex justify-content-center align-items-center">
                @if ($user->image)
                    <img src="{{ Storage::url($user->image->url) }}" width="150" height="150" class="profile-img rounded-circle" alt="">
                @else
                    <img src="{{ asset('frontend/assets/user-img-profile.png') }}" width="150" height="150" class="profile-img rounded-circle" alt="">
                @endif
            </div>
            <div class="profile-detail">
                <p id="name">{{ $user->name }}</p>
                <p id="email">{{ $user->email }}</p>
                <a href="{{ route('frontend.profiles.edit') }}" class="btn btn-edit-profile">
                    <img src="{{ asset('frontend/assets/icon/user.svg') }}" alt=""> Edit Profile
                </a>
            </div>
            <div class="total-course ml-auto">
                <h3 style="font-size:24px;font-weight: 500;color: #909090;">Total Course</h3>
                <p style="font-size:60px;font-weight: 500;color:#0F0E20;opacity:0.6" class="text-center">{{ $user->courses()->count() }}</p>
            </div>
        </div>
    </section>
    <section class="container profile-course">
        <h3 class="text-left">My Course</h3>
        <hr>
        <div class="row">
            @foreach ($user->courses as $course)
                <div class="col-lg-4 mb-3">
                    <div class="card" style="width: 100%;">
                        <a href="{{ route('frontend.courses.watch', ['id' => $course->id]) }}">
                            @if ($course->pivot->finished)
                                <button class="btn btn-primary" id="btn-finished">FINISHED</button>
                            @endif
                            <img class="card-img-top" src="{{ $course->image ? Storage::url($course->image->url) : Storage::url('course-images/default-2.png') }}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <div class="box-title">
                                <h5 class="card-title">{{ $course->name }}</h5>
                            </div>
                            <img src="{{ asset('frontend/assets/icon/clock.svg') }}" alt="">
                            <p class="card-text ml-4">Valid until {{ formatDate($course->pivot->expired_at, 'd F Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@section('footer')
    @include('frontend.partials.footer', ['bgColor' => '#ffffff', 'useHr' => true, 'useLogo' => true, 'columnSize' => 'col-lg-3'])
@endsection
