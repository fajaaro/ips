@include('frontend.partials.head', [
    'useMainCss' => false,
    'useIncourseCss' => true,
    'usePhilosopherFontFamily' => false,
    'useOwlCarouselCss' => false,
    'useAOSCss' => false
])

<body>
    @include('frontend.partials.navbar')

    <section class="container course p-0">
        <section class="row course-header m-1">
            <div class="col-lg-8" style="background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(0, 0, 0, 0.5)), to(rgba(0, 0, 0, 0.5))), url({{ Storage::url($course->image->url) }}); background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{ Storage::url($course->image->url) }}); background-repeat: no-repeat; background-size: auto; padding: 30px; background-color: #ffffff; width: 780px; height: 340px; border-radius: 10px;">

                <h1>{{ $course->name }}</h1>
                <div class="desc d-flex justify-content-between">
                    @if (Auth::user()->hasCourse($course->id))
                        <a href="{{ route('frontend.courses.watch', ['id' => $course->id]) }}" class="course-btn m-0">See Course</a>                
                        <p class="course-price m-0">Purchased</p>
                    @else
                        <a href="course-in.html" class="course-btn m-0">Buy This Course</a>                
                        <p class="course-price m-0">{{ formatRupiah($course->price) }}</p>
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
    
    @include('frontend.partials.footer', ['bgColor' => '#e5e5e5', 'useHr' => true, 'useLogo' => true, 'columnSize' => 'col-lg-3'])

    <script src="{{ asset('frontend/library/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/library/bootstrap.min.js') }}"></script>
</body>

</html>
