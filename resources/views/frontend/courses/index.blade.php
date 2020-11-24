@include('frontend.partials.head', [
    'useMainCss' => true,
    'useIncourseCss' => false,
    'usePhilosopherFontFamily' => false,
    'useOwlCarouselCss' => false,
    'useAOSCss' => false
])

<body>
    @include('frontend.partials.navbar')

    <main>
        <div class="container courses">
            <div class="row">
                <div class="col-lg-3">
                    <h1 class="my-4">Our Courses</h1>
                    <div class="list-group">
                        <a href="{{ route('frontend.courses.index') . Request::query('type') == 'bundle' ? '?type=bundle' : '' }}" class="list-group-item {{ request()->is('courses') && !Request::query('category') ? 'course-category-active' : '' }}">All Course</a>

                        @foreach ($courseCategories as $category)
                            <a href="{{ route('frontend.courses.index') . $getRequests . strToSlug($category->name) }}" class="list-group-item {{ slugToStr(Request::query('category')) == strtolower($category->name) ? 'course-category-active' : '' }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <!-- /.col-lg-3 -->
                <div class="col-lg-9">
                    <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img class="d-block img-fluid " src="{{ asset('frontend/assets/Superior/Chloe.jpg') }}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="{{ asset('frontend/assets/Superior/Dome Chocolate Mousse.jpg') }}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" src="{{ asset('frontend/assets/Superior/Pannacota.jpg') }}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="row">
                        @foreach ($courses as $course)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <a href="course-about.html"><img class="card-img-top" src="{{ Storage::url($course->image->url) }}" alt=""></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="course-about.html">{{ $course->name }}</a>
                                        </h4>
                                        <h5>{{ formatRupiah($course->price) }}</h5>
                                        <p class="card-text">{!! $course->overview !!}</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('frontend.courses.show', ['id' => $course->id]) }}">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
        </div>
    </main>

    @include('frontend.partials.footer', ['bgColor' => '#ffffff', 'useHr' => true, 'useLogo' => true, 'columnSize' => 'col-lg-3'])

    <script src="{{ asset('frontend/library/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/library/bootstrap.min.js') }}"></script>
</body>

</html>
