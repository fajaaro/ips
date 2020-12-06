@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/style/incourse.css') }}">
@endpush

@push('fonts')
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
@endpush

@section('navbar')
    @include('frontend.partials.navbar')
@endsection

@section('content')
    <section class="container course p-0">
        <section class="row course-header m-1">
            @include('flash')
            
            <div class="col-lg-8" style="background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.5)), to(rgba(0, 0, 0, 0.5))), url({{ $course->image ? Storage::url($course->image->url) : Storage::url('course-images/default-2.png') }}); background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ $course->image ? Storage::url($course->image->url) : Storage::url('course-images/default-2.png') }}); background-repeat: no-repeat; background-size: 100% 100%; padding: 30px; background-color: #ffffff; width: 780px; height: 340px; border-radius: 10px;">

                <h1>{{ $course->name }}</h1>
                <div class="desc d-flex justify-content-between">
                    @if (Auth::user()->hasCourse($course->id))
                        <a href="{{ route('frontend.courses.watch', ['id' => $course->id]) }}" class="course-btn m-0">See Course</a>                
                        <p class="course-price m-0">Purchased</p>
                    @else
                        @if ($course->price > 0)
                            @if (!Auth::user()->hasUnpaidOrder($course->id))
                                <form action="{{ route('frontend.orders.store') }}" method="post" class="d-none">
                                    @csrf 

                                    <input type="hidden" name="order_type" value="single">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">

                                </form>

                                <a href="#" class="course-btn m-0 btn-buy-course">Buy This Course</a> 
                            @else
                                <p class="course-btn m-0">Buyed</p>
                            @endif
                            
                            <p class="course-price m-0">{{ formatRupiah($course->price) }}</p>
                        @endif               
                    @endif
                </div>
            </div>
            <div class="col-lg-3 ml-auto mr-0 course-bonuses">
                <div class="course-header-detail">
                    <div class="detail d-flex flex-column align-items-center ">
                        <img class="" src="{{ asset('frontend/assets/vector-user.png') }}" alt="">
                        <p class="">{{ $course->users()->count() }}</p>
                    </div>
                    <div class="detail d-flex flex-column align-items-center ">
                        <img class="" src="{{ asset('frontend/assets/icon/tick.svg') }}" alt="">
                        <p class="">Sertification</p>
                    </div>
                    <div class="detail d-flex flex-column align-items-center">
                        <img class="" src="{{ asset('frontend/assets/icon/tick.svg') }}" alt="">
                        <p class="">2X Video Call</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="row course-body m-1">
            <div class="col-lg-8 p-0">
                <h1>
                    Overview
                </h1>
                <hr />
                <div class="box-overview ml-4">
                    {!! $course->overview !!}
                </div>
            </div>
        </section>
    </section>
@endsection

@section('footer')
    @include('frontend.partials.footer', ['bgColor' => '#e5e5e5', 'useHr' => true, 'useLogo' => true, 'columnSize' => 'col-lg-3'])
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.btn-buy-course').on('click', function() {
                $(this).prev().submit()
            })
        })
    </script>
@endpush