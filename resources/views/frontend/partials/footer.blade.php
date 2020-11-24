<footer class="footer-section" style="background: {{ $bgColor }};">
    <div class="container">
        @if ($useHr)
            <hr>
        @endif
    
        <div class="row">
            @if ($useLogo)
                <div class="{{ $columnSize }}">
                    <div class="footer-left mt-3">
                        <div class="footer-logo">
                            <a href="#"><img src="{{ asset('frontend/assets/logo.png') }}" alt="" /></a>
                        </div>
                    </div>
                </div>
            @endif
            <div class="{{ $columnSize }}">
                <div class="footer-widget mt-3">
                    <h5>Information</h5>
                    <ul class="m-0 p-0">
                        <li class="text-left"><a href="#">About Us</a></li>
                        <li class="text-left"><a href="#">Checkout</a></li>
                        <li class="text-left"><a href="#">Contact</a></li>
                        <li class="text-left"><a href="#">Serivius</a></li>
                    </ul>
                </div>
            </div>
            <div class="{{ $columnSize }}">
                <div class="footer-widget mt-3">
                    <h5>Office</h5>
                    <ul class="m-0 p-0">
                        <li><a href="#">hi@ipscourse.com</a></li>
                        <li><a href="#">PIK, North Jakarta</a></li>
                    </ul>
                </div>
            </div>
            <div class="{{ $columnSize }}">
                <div class="footer-widget mt-3">
                    <h5>My Account</h5>
                    <ul class="m-0 p-0">
                        <li><a href="{{ route('frontend.profiles.index') }}">My Account</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Shopping Cart</a></li>
                        <li><a href="#">Shop</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-reserved">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                        Copyright &copy;2020
                        All rights reserved | Indonesia Patisserie School
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>