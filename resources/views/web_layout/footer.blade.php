<!-- footer -->
<section class="w3l-footer-16">
    <div class="w3l-footer-16-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-8 col-md-6 col-12 column pr-lg-0">
                            <a class="logo" href="/">
                                <img src="/assets/images/logo.webp" class="img-responsive" style="height: 56px"
                                    alt="">
                            </a>
                            <p class="mt-4">At Legacy Remodeling & Restoration, we believe that building long-lasting
                                relationships with our clients is just as important as delivering exceptional
                                craftsmanship. Serving homeowners throughout the Maryland suburbs and surrounding areas,
                                our mission is to protect, restore, and enhance homes with services built on trust,
                                integrity, and quality.</p>
                        </div>
                        <div class="col-lg-2 col-md-3 col-12 column pr-lg-0">
                            <h3>Pages</h3>
                            <ul class="footer-gd-16">
                                <li class="nav-item active">
                                    <a href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('about_us') }}">About</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('services') }}">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('portfolio') }}">Portfolio</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact_us') }}">Contact</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-2 col-md-3 col-12 column pr-lg-0">
                            <h3>Services</h3>
                            <ul class="footer-gd-16">
                                <li class="nav-item active">
                                    <a href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('services') }}">Roofing</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('services') }}">Siding</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('services') }}">Gutters</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('services') }}">Restoration</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 column column4 mt-lg-0 mt-4">
                    <h3>Our Offer </h3>
                    <div class="end-column">
                        <h3>Knock Us for Exclusive Offers</h3>
                        <form action="#" class="subscribe" method="post">
                            <input type="email" name="email" placeholder="Email Address" required="">
                            <button><span class="fa fa-paper-plane" aria-hidden="true"></span></button>
                        </form>
                        <p>Contact us today and unlock special discounts & limited-time deals!</p>
                    </div>
                </div>
            </div>
            <div class="d-flex below-section justify-content-between align-items-center pt-4 mt-5">
                <div class="columns text-left">
                    <p>@ {{ date('Y') }} Mend. All rights reserved. Design by <a
                            href="{{ config('company.developer_web') }}" target="_blank">
                            {{ config('company.developer_name') }}</a>
                    </p>
                </div>
                <div class="columns-2 mt-md-0 mt-3">
                    <ul class="social">
                        <li><a href="#facebook"><span class="fab fa-facebook" aria-hidden="true"></span></a>
                        </li>
                        <li><a href="#linkedin"><span class="fab fa-linkedin" aria-hidden="true"></span></a>
                        </li>
                        <li><a href="#twitter"><span class="fab fa-twitter" aria-hidden="true"></span></a>
                        </li>
                        <li><a href="#google"><span class="fab fa-google-plus" aria-hidden="true"></span></a>
                        </li>
                        <li><a href="#github"><span class="fab fa-github" aria-hidden="true"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <a href="https://wa.me/4438054609" target="_blank" class="wp_sticky_popup">
        <i style="padding: 13px; font-size: 26px;" class="fab fa-whatsapp" aria-hidden="true"></i>
    </a>


    {{-- Inquire Model --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Enquire Now</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="search-form p-sm-4">
                        <input type="search" name="search" placeholder="Enter Name.." required>
                    </div>
                    <div class="search-form p-sm-4">
                        <input type="search" name="search" placeholder="Enter Email.." required>
                    </div>
                    <div class="search-form p-sm-4">
                        <input type="search" name="search" placeholder="Enter Number.." required>
                    </div>
                    <div class="search-form p-sm-4">
                        <textarea name="" type="search" id="" cols="30" rows="5"></textarea>
                    </div>
                    <div class="search-form p-sm-4">

                        <button type="submit" class="button raised hoverable btn m-0 text-center">
                            <div class="anim"></div><span>Submit</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .wp_sticky_popup {
            position: fixed;
            bottom: 30px;
            left: 5px;
            z-index: 9;
            font-size: 16px;
            border: none;
            outline: none;
            cursor: pointer;
            color: #fff;
            width: 50px;
            height: 50px;
            background: #4CAF50;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            -o-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            padding: 0;
        }
    </style>
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fa fa-angle-up"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- //move top -->
    <script>
        $(function() {
            $('.navbar-toggler').click(function() {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
</section>
<!-- //footer -->

<script src="/assets/js/owl.carousel.js"></script>
<script src="/assets/js/custom.js"></script>

@yield('scripts')
</body>


</html>
