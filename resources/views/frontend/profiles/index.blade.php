@include('frontend.partials.head', [
    'useMainCss' => true,
    'useIncourseCss' => false,
    'usePhilosopherFontFamily' => false,
    'useOwlCarouselCss' => false,
    'useAOSCss' => false
])

<body>
    @include('frontend.partials.navbar')

    <section class="container profile-dashboard">
        <div class="row">
            <img src="{{ asset('frontend/assets/user-img-profile.png') }}" class="profile-img">
            <div class="profile-detail">
                <p id="name">{{ $user->name }}</p>
                <p id="email">{{ $user->email }}</p>
                <a href="profile-edit.html" class="btn btn-edit-profile">
                	@if ($user->image)
                		<img src="{{ Storage::url($user->image->url) }}" alt=""> Edit Profile
                	@else
	                 	<img src="{{ asset('frontend/assets/vector-user.svg') }}" alt=""> Edit Profile
                	@endif
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
	                    <a href=""><img class="card-img-top" src="{{ Storage::url($course->image->url) }}" alt="Card image cap"></a>
	                    <div class="card-body">
	                        <h5 class="card-title">{{ $course->name }}</h5>
	                        <img src="{{ asset('frontend/assets/icon/clock.svg') }}" alt="">
	                        <p class="card-text ml-4">Valid until {{ formatDate($course->pivot->expired_at, 'd F Y') }}</p>
	                    </div>
	                </div>
	            </div>
        	@endforeach
        </div>
    </section>
    
    @include('frontend.partials.footer', ['bgColor' => '#ffffff', 'useHr' => true, 'useLogo' => true, 'columnSize' => 'col-lg-3'])

    <script src="{{ asset('frontend/library/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/library/bootstrap.min.js') }}"></script>
</body>

</html>
