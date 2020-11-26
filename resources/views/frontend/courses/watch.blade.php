@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/style/main.css') }}">
@endpush

@push('fonts')
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid navigation">
        <nav class="row navbar navbar-expand-lg navbar-dark">
            <a href="{{ route('home') }}" class="navbar-brand ml-auto mr-auto">
                <img src="{{ asset('frontend/assets/logo-navbar.png') }}" alt="Indonesia Patisserie School" />
            </a>
        </nav>
    </div>
    <div class="container-fluid incourse">
        <div class="row">
            <div class="col-lg-4 p-0 m-0">
                <aside class="sidebar" id=sidebar>
                    <ul class="nav-menu flex-column nav-pills">
                        <div class="mt-4">{!! $course->tools !!}</div>
                        <div class="mt-3">{!! $course->recipes !!}</div>
                        <div class="mt-3">{!! $course->steps !!}</div>
                    </ul>
                </aside>
            </div>
            <div class="col-lg-7 p-0">
                <div class="course-title-header d-flex justify-content-between align-items-center">
                    <h6 class="mt-4">{{ $course->name }}</h6>
                    <a href="index.html" class="btn btn-primary">FINISH</a>
                </div>
                <div class="embed-responsive embed-responsive-16by9">
                    <div class="plyr__video-embed" id="player">
                        <iframe width="560" height="315" src="{{ $course->courseVideo->url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="incourse-footer">
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            Copyright &copy;Indonesia Patisserie School
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
