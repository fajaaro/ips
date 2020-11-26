@include('frontend.partials.head', [
    'useMainCss' => true,
    'useIncourseCss' => false,
    'usePhilosopherFontFamily' => true,
    'useOwlCarouselCss' => true,
    'useAOSCss' => true
])

<body>
    <img src="{{ asset('frontend/assets/logo.png') }}" style="width:180px;height:198px" class="position-absolute large-logo">
    <div class="container-fluid nav-header text-center">
        <img src="{{ asset('frontend/assets/nav-header-img.png') }}" alt="" class="w-100">
    </div>
    <div class="container-fluid navigation">
        <nav class="row navbar navbar-expand-lg navbar-light">
            <a href="#" class="navbar-brand">
                <!-- <img src="src/assets/logo-navbar.png" alt="Indonesia Patisserie School" /> -->
            </a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navb">
                <ul class="navbar-nav ml-auto mr-3 d-flex align-items-center">
                    <li class="nav-item mx-md-2">
                        <a href="{{ route('frontend.courses.index') }}" class="nav-link actived ">Courses</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="{{ route('frontend.courses.index') . '?type=bundle' }}" class="nav-link">Bundle</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="courses.html" class="nav-link">About</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="courses.html" class="nav-link">About</a>
                    </li>
                    <li class="nav-item mx-md-2">
                        <a href="#" class="nav-link">
                            @if (Auth::user()->image)
                                <img src="{{ Storage::url(Auth::user()->image->url) }}" width="40" height="40" class="rounded-circle" alt="">
                            @else
                                <img src="{{ asset('frontend/assets/vector-user.svg') }}" width="40" height="40" class="rounded-circle" alt="">
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">Hi, {{ $user->first_name }}</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('frontend.profiles.index') }}" class="dropdown-item" style="color: #000000;">My Account</a>
                            <a href="{{ route('logout') }}" class="dropdown-item" style="color: #000000;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <header class="text-center">
        <div class="row p-0 m-0 d-flex align-items-center">
            <div class="col-lg-4 ">
                <img src="{{ asset('frontend/assets/master aing.png') }}" alt="" class="img-fluid m-0">
            </div>
            <div class="col-lg-8">
                <div class="carousel shadow-lg">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <img src="{{ asset('frontend/assets/homepage-img/Sweet Bun.jpg') }}" alt="img1" class="img-fluid" />
                        </div>
                        <div class="item">
                            <img src="{{ asset('frontend/assets/homepage-img/Cendol cake.jpg') }}" alt="img1" class="img-fluid" />
                        </div>
                        <div class="item">
                            <img src="{{ asset('frontend/assets/homepage-img/cookies lebaran.jpg') }}" alt="img1" class="img-fluid" />
                        </div>
                    </div>
                </div>
                <p>
                    Earn your pastry & baking certificate online with <br>
                    <span>Indonesia Pattiserie School</span>
                </p>
                <a href="{{ route('frontend.courses.index') }}" class="btn-get-started text-decoration-none">See All Course</a>
            </div>
        </div>
    </header>
    <section class="container-fluid container-testimonials">
        <h1 class="my-5 text-center">What Does People Say</h1>
        <div class="container carousel">
            <div class="owl-carousel owl-theme">
                <div class="row client">
                    <div class="col-lg-4 col-md-12 client-img">
                        <img src="{{ asset('frontend/assets/testimonial/1.png') }}" alt="img1" class="img-fluid" />
                    </div>
                    <div class="col-lg-8 col-md-12 about-client text-left">
                        <h4 class="">Yobelina</h4>
                        <h6>Basic Class</h6>
                        <p class="para mt-4">
                            Baking class has been a lot of fun to begin with. Especially when you have a fun teacher and friend to bake
                            together. It is such a great experience and knowledge to be able to learn baking in IPS. I feel like a
                            have solid core of knowledge (bread) wich i can use to startup with my career.
                        </p>
                    </div>
                </div>
                <div class="row client">
                    <div class="col-lg-4 col-md-12 client-img">
                        <img src="{{ asset('frontend/assets/testimonial/2.png') }}" alt="img2" class="img-fluid" />
                    </div>
                    <div class="col-lg-8 col-md-12 about-client text-left">
                        <h4 class="">Nisia</h4>
                        <h6>Intermediate Class</h6>
                        <p class="para mt-4">
                            For sure. I can learn by doing only in IPS, i’ve got so many lessons here and learn how to make a cake correctly
                        </p>
                    </div>
                </div>
                <div class="row client">
                    <div class="col-lg-4 col-md-12 client-img">
                        <img src="{{ asset('frontend/assets/testimonial/3.png') }}" alt="img2" class="img-fluid" />
                    </div>
                    <div class="col-lg-8 col-md-12 about-client text-left">
                        <h4 class="">Rachel Livia</h4>
                        <h6>Intermediate Class</h6>
                        <p class="para mt-4">
                            Saya belajar banyak dari IPS, banyak ilmu baru yang didapat. Senang belajar di Indonesia Pattisserie School.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.footer', ['bgColor' => '#ffffff', 'useHr' => false, 'useLogo' => false, 'columnSize' => 'col-lg-4'])

    <script src="{{ asset('frontend/library/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/library/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('frontend/library/owl-carousel/js/owl.carousel.min.js') }}"></script>
    <script>
    AOS.init();
    $('.row .carousel .owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            560: {
                items: 3
            }
        }
    })

    $('.container-fluid .carousel .owl-carousel').owlCarousel({
        loop: true,
        autoplay: true,
        dots: true,
        responsive: {
            0: {
                items: 1
            },
            560: {
                items: 2
            }
        }
    })

    </script>
</body>

</html>
