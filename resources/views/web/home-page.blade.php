@extends('web_layout.main')
@section('content')
    <section class="w3l-main-slider" id="home">
        <div class="companies20-content">
            <div class="companies-wrapper"></div>
            <div class="owl-one owl-carousel owl-theme">
                <div class="item">
                    <li class="banner-view banner-top1 bg bg2">
                        <div class="slider-info">
                            <div class="banner-info">
                                <div class="container">
                                    <div class="banner-info-bg">
                                        <div class="row align-items-center py-lg-5 py-3">
                                            <div class="col-lg-6 col-md-8 content-left">
                                                <h3 lass="sub-title-top">Protecting Homes </h3>
                                                <h3 lass="sub-title-top"> Peace of Mind</h3>
                                                <p>Quality Roofing and Exterior Remodeling Contractors</p>
                                                <a href="{{ route('about_us') }}" class="button raised hoverable">
                                                    <div class="anim"></div><span>Enquire Now</span>
                                                </a>
                                            </div>
                                            <div class="col-12 col-lg-6 col-md-4 content-right">
                                                <div class="card" style="background-color: #ffffffc7;">
                                                    <form action="">
                                                        <div class="modal-body">
                                                            <div class="search-form p-sm-4">
                                                                <input type="search" class="border border-dark"
                                                                    name="search" placeholder="Enter Name.." required>
                                                            </div>
                                                            <div class="search-form p-sm-4">
                                                                <input type="search" class="border border-dark"
                                                                    name="search" placeholder="Enter Email.." required>
                                                            </div>
                                                            <div class="search-form p-sm-4">
                                                                <input type="search" class="border border-dark"
                                                                    name="search" placeholder="Enter Number.." required>
                                                            </div>
                                                            <div class="search-form p-sm-4">
                                                                <textarea name="" class="border border-dark" type="search" id="" cols="30" rows="5"></textarea>
                                                            </div>
                                                            <div class="search-form p-sm-4">

                                                                <button type="submit"
                                                                    class="button raised hoverable btn m-0 text-center"
                                                                    style="border: 1px solid var(--title-color) !important; text-align: center !important;">
                                                                    <div class="anim"></div><span>Submit</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                <div class="item">
                    <li class="banner-view banner-top3 bg bg2">
                        <div class="slider-info">
                            <div class="banner-info">
                                <div class="container">
                                    <div class="banner-info-bg">
                                        <div class="row align-items-center py-lg-5 py-3">
                                            <div class="col-lg-6 col-md-8 content-left">
                                                <h3 lass="sub-title-top">Explore Premium</h3>
                                                <h3 lass="sub-title-top"> Windows</h3>
                                                <p>Ut posuere aliquet erat, non interdum lectus. Donec enim lectus,
                                                    elementum sit amet magna
                                                    faucibus.</p>
                                                <a href="{{ route('about_us') }}" class="button raised hoverable">
                                                    <div class="anim"></div><span>Enquire Now</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
                <div class="item">
                    <li class="banner-view banner-top2 bg bg2">
                        <div class="slider-info">
                            <div class="banner-info">
                                <div class="container">
                                    <div class="banner-info-bg">
                                        <div class="row align-items-center py-lg-5 py-3">
                                            <div class="col-lg-6 col-md-8 content-left">
                                                <h3 lass="sub-title-top">Windows & Doors </h3>
                                                <h3 lass="sub-title-top"> Specialists! </h3>
                                                <p>Ut posuere aliquet erat, non interdum lectus. Donec enim lectus,
                                                    elementum sit amet magna
                                                    faucibus.</p>
                                                <a href="{{ route('about_us') }}" class="button raised hoverable">
                                                    <div class="anim"></div><span>Enquire Now</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <section class="w3l-text-6 py-5" id="about">
        <div class="text-6-mian py-md-5">
            <div class="container">
                <div class="row top-cont-grid align-items-center">
                    <div class="col-lg-6 left-img pr-lg-4">
                        <img src="/assets/images/index1.jpg" alt="" class="img-responsive img-fluid" />
                    </div>
                    <div class="col-lg-6 text-6-info mt-lg-0 mt-4">
                        <h6>Welcome to Legacy Remodeling & Restoration</h6>
                        <h2>Mission Statement <span>Professionals</span></h2>
                        <p>At Legacy Remodeling & Restoration, we take pride in being your one-stop solution for home
                            improvement,
                            repair, and restoration needs. Whether it’s protecting your roof, upgrading your siding,
                            installing gutters, or restoring your home after unexpected damage, our team is here to deliver
                            reliable results with unmatched craftsmanship.</p>
                        <p>
                            We understand that your home is more than just a place — it’s your safe space, your investment,
                            and your comfort zone. That’s why every service we provide is designed to protect, beautify, and
                            strengthen your property for years to come.</p>
                        <a href="{{ route('about_us') }}" class="button raised hoverable btn">
                            <div class="anim"></div><span>Read More</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- features -->
    <section class="w3l-feature-9">
        <div class="main-w3">
            <div class="heading text-center mx-auto">
                <h3 class="head">Our Services</h3>
                <p class="my-3 head">At Legacy Remodeling & Restoration, we take pride in being your one-stop solution for
                    home improvement, repair, and restoration needs. Whether it’s protecting your roof, upgrading your
                    siding, installing gutters, or restoring your home after unexpected damage, our team is here to deliver
                    reliable results with unmatched craftsmanship.</p>
            </div>
            <div class="container">
                <div class="row main-cont-wthree-fea">
                    @forelse ($get_all_services as $get_all_services_data)
                        <x-our-services-web-card :card_icon_class="$get_all_services_data->icon_class" :card_route="route('services', $get_all_services_data->slug)" :card_name="$get_all_services_data->service_name" :card_title="$get_all_services_data->service_description" />
                    @empty
                        <div class="col-12">
                            <p class="p-5 text-center text-dark head"> No Services Found. </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!-- //features -->

    <section class="w3l-text-6 py-5" id="about">
        <div class="text-6-mian py-md-5">
            <div class="container">
                <div class="row top-cont-grid align-items-center">
                    <div class="col-lg-6 text-6-info mt-lg-0 mt-4">
                        <h6>Welcome to our Vision</h6>
                        <h2>Remodeling & Restructure <span>Professionals</span></h2>
                        <p>At Legacy Remodeling & Restoration, our mission is to protect and restore the homes in our
                            community by providing trusted, durable, and cost-effective roofing, remodeling, and restoration
                            solutions. We are dedicated to delivering exceptional craftsmanship, transparency, and superior
                            customer service—building lasting relationships one project at a time.</p>
                        <a href="{{ route('about_us') }}" class="button raised hoverable btn">
                            <div class="anim"></div><span>Read More</span>
                        </a>
                    </div>
                    <div class="col-lg-6 left-img pr-lg-4">
                        <img src="/assets/images/index11.jpg" alt="" class="img-responsive img-fluid" />
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="w3l-portfolios-1">
        <div class="portfolio">
            <div class="container">
                <h3 class="title-main">Our Portfolio</h3>
                <p class="sub-title">At the heart of our work lies a passion for quality, innovation, and client
                    satisfaction. Our portfolio showcases a diverse range of successful projects that highlight our
                    expertise in Roofing, Siding, Gutters, and Restoration, as well as other custom solutions for both
                    residential and commercial properties.</p>
                <div class="container my-4">
                    <div class="row g-3">
                        @foreach ($portfolio_images as $index => $img)
                            @if ($index % 5 == 0)
                                <div class="col-md-6 p-2">
                                    <a href="#">
                                        <img src="{{ asset($img->file_path) }}" alt="Main Image"
                                            class="img-fluid w-100 h-100"
                                            style="object-fit: cover; border-radius: 8px;" />
                                    </a>
                                </div>

                                <div class="col-md-6 p-2 d-flex flex-column">
                                    <div class="row g-3 flex-fill">
                                    @else
                                        <div class="col-6 p-2">
                                            <a href="#">
                                                <img src="{{ asset($img->file_path) }}" alt="Portfolio"
                                                    class="img-fluid w-100 h-100"
                                                    style="object-fit: cover; border-radius: 8px;" />
                                            </a>
                                        </div>
                            @endif
                            @if ($index % 5 == 4)
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        </div>
        </div>
    </section>



    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <!-- /index-block2 -->

    <div class="w3l-index-block4 py-5">
        <div class="features-bg py-md-5" style="background-color: #f5fcff;">
            <div class="container py-md-3">
                <div class="heading text-center mx-auto">
                    <h3 class="head">Why Chose Us</h3>
                    <p class="my-3 head"> Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                        cubilia Curae;
                        Nulla mollis dapibus nunc, ut rhoncus
                        turpis sodales quis. Integer sit amet mattis quam.</p>
                </div>
                <div class="row">
                    @forelse ($get_wcu as $get_wcu_data)
                        <x-why-choose-us-web :card_bg_color="'unset'" :cta="route('about_us')" :wcu_icon="$get_wcu_data->icon" :title="$get_wcu_data->title"
                            :description="$get_wcu_data->description" />
                    @empty
                        <div class="col-12">
                            <p class="p-5 text-center text-dark head"> No Data Found. </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- content-with-photo17 -->
    <section class="w3l-index-block7">
        <div class="sub-content py-5">
            <div class="container py-md-5">
                <div class="row cwp17-two align-items-center">
                    <div class="col-md-6 cwp17-text">
                        <h2>“Home Roofing Now Just $3,499 ”</h2>
                        <p>Give your home the protection it deserves with our limited-time roofing special. For only $3,499,
                            we provide a complete roof removal and replacement package designed to keep your home safe,
                            durable, and beautiful for years to come.</p>
                        <a href="{{ route('about_us') }}" class="button raised hoverable btn">
                            <div class="anim"></div><span>Read More</span>
                        </a>
                    </div>
                    <div class="col-md-6 cwp17-image">
                        <img src="/assets/images/index2.jpg" class="img-fluid" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- index-block2 -->
    <section class="w3l-index-block2 pt-3">
        <div class="container py-3">
            <div class="heading text-center mx-auto">
                <h3 class="head">From Roof to Foundation </h3>
                <p class="my-3 head">At our company, we believe that a strong home or commercial property starts with
                    quality craftsmanship, trusted expertise, and long-lasting protection. That’s why our services are
                    designed to cover every essential element that keeps your property safe, functional, and beautiful. From
                    the roof above your head to the siding on your walls and the gutters that protect your foundation, we
                    ensure every detail is taken care of with precision.</p>
            </div>
            <div class="row bottom_grids mt-5 pt-lg-3">
                @foreach ($get_all_services as $service_data)
                    <div class="col-lg-3 col-md-6 column mt-3 mb-4">
                        <x-service-card :route="route('portfolio')" :is_media="$service_data->media" :media_path="$service_data->media->file_path" :service_name="$service_data->service_name"
                            :service_title="$service_data->service_title" />
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>



    {{-- Timeline Start --}}
    <!-- timeline block -->
    {{-- <section class="w3l-timeline-block py-5">
        <div class="timeline section-gap py-md-3">
            <div class="container">
                <div class="timeline-item">
                    <div class="timeline-img"></div>

                    <div class="timeline-content js--fadeInLeft">
                        <h2>Title Goes Here</h2>
                        <div class="date">Jan 06 2019</div>
                        <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ipsa ratione
                            omnis alias
                            cupiditate saepe
                            atque totam aperiam sed nulla voluptatem recusandae dolor, nostrum excepturi amet in
                            dolores. Alias, ullam.
                        </p>
                        <a href="{{ route('about_us') }}" class="button raised hoverable">
                            <div class="anim"></div><span>Read More</span>
                        </a>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-img"></div>
                    <div class="timeline-content timeline-card js--fadeInRight">
                        <div class="timeline-img-header">

                        </div>
                        <div class="date">Mar 07 2019</div>
                        <div class="bottom-cont">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ipsa ratione omnis alias
                                cupiditate
                                saepe
                                atque totam aperiam sed nulla voluptatem recusandae dolor, nostrum excepturi amet in
                                dolores. Alias,
                                ullam.
                            </p>
                            <a href="{{ route('about_us') }}" class="button raised hoverable">
                                <div class="anim"></div><span>Read More</span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="timeline-item">
                    <div class="timeline-img"></div>
                    <div class="timeline-content js--fadeInLeft">
                        <div class="date">June 13 2019</div>
                        <h2>Quote</h2>
                        <blockquote class="blockquote">
                            <p class="mb-0 mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer
                                posuere erat a ante.
                                Maxime
                                ipsa ratione omnis alias cupiditate saepe.</p>
                            <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source
                                    Title</cite></footer>
                        </blockquote>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-img"></div>
                    <div class="timeline-content js--fadeInRight">
                        <h2 class="mt-4">Title Goes Here</h2>
                        <div class="date">Aug 28 2019</div>
                        <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime ipsa ratione
                            omnis alias
                            cupiditate saepe
                            atque totam aperiam sed nulla voluptatem recusandae dolor, nostrum excepturi amet in
                            dolores. Alias, ullam.
                        </p>
                        <a href="{{ route('about_us') }}" class="button raised hoverable">
                            <div class="anim"></div><span>Read More</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- Timeline End --}}

    <!-- content-with-photo17 -->
    {{-- <div class="w3l-cutomer-main-cont bg-light">
        <div class="testimonials text-center py-5">
            <div class="container py-md-5">
                <div class="heading text-center mx-auto">
                    <h3 class="head">Customers Say</h3>
                    <p class="my-3 head"> Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                        cubilia
                        Curae, Nulla mollis dapibus nunc, ut rhoncus
                        turpis sodales quis. Integer sit amet mattis quam.</p>
                </div>
                <div class="row content-sec mt-md-5 mt-4">
                    <div class="col-lg-4 col-md-6 testi-sections">
                        <div class="testimonials_grid">
                            <p class="sub-test"><span class="fa fa-quote-left mr-2" aria-hidden="true"></span> Nam
                                libero
                                tempore, cum soluta
                                nobis est eligendi optio cumque nihil impedit.
                            </p>
                            <div class="d-grid sub-author-con">
                                <div class="testi-img-res">
                                    <img src="/assets/images/testi1.jpg" alt="" class="img-responsive" />
                                </div>
                                <div class="testi_grid text-left">
                                    <h5 class="mb-1">Petey Cruis</h5>
                                    <p>Caption Here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-md-0 mt-4 testi-sections">
                        <div class="testimonials_grid">
                            <p class="sub-test"><span class="fa fa-quote-left mr-2" aria-hidden="true"></span> Nam
                                libero
                                tempore, cum soluta
                                nobis est eligendi optio cumque nihil impedit.
                            </p>
                            <div class="d-grid sub-author-con">
                                <div class="testi-img-res">
                                    <img src="/assets/images/testi2.jpg" alt="" class="img-responsive" />
                                </div>
                                <div class="testi_grid text-left">
                                    <h5 class="mb-1">Molive Joe</h5>
                                    <p>Caption Here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mt-lg-0 mt-4 testi-sections">
                        <div class="testimonials_grid">
                            <p class="sub-test"><span class="fa fa-quote-left mr-2" aria-hidden="true"></span> Nam
                                libero
                                tempore, cum soluta
                                nobis est eligendi optio cumque nihil impedit.
                            </p>
                            <div class="d-grid sub-author-con">
                                <div class="testi-img-res">
                                    <img src="/assets/images/testi.jpg" alt="" class="img-responsive" />
                                </div>
                                <div class="testi_grid text-left">
                                    <h5 class="mb-1">Paige Turner</h5>
                                    <p>Caption Here</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- faq page -->
    {{-- <div class="w3l-faq-main py-5">
        <div class="faq-sec sec-padding py-md-5">
            <div class="container">
                <!-- faq -->
                <div class="row faq-cont">
                    <div class="col-md-12 about-right-faq">
                        <div class="heading text-center mx-auto">
                            <h3 class="head">Frequently asked questions</h3>
                            <p class="my-3 head"> Estibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                                cubilia Curae
                                Nulla mollis dapibus nunc, ut rhoncus
                                turpis sodales quis.</p>
                        </div>
                        <!-- //faq -->
                        <!-- accordions -->
                        <div class="sub-accor">
                            <ul class="accordion css-accordion">
                                <li class="accordion-item">
                                    <input class="accordion-item-input" type="checkbox" name="accordion" id="item2"
                                        checked />
                                    <label for="item2" class="accordion-item-hd">Lorem ipsum dolor sit amet? <span
                                            class="accordion-item-hd-cta">&#9650;</span></label>
                                    <div class="accordion-item-bd accordion-item-bd-2">
                                        <h6 class="accordion-textm">Dolores et ea rebum lorem ipsum</h6>
                                        <p>Duo dolores et ea rebum. Lorem ipsum dolor sit ametLorem ipsum
                                            dolor sit amet,sed diam nonumy. Consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <input class="accordion-item-input" type="checkbox" name="accordion"
                                        id="item1" />
                                    <label for="item1" class="accordion-item-hd">At vero eos et accusamus et iusto odio
                                        dignissimos ducimus? <span class="accordion-item-hd-cta">&#9650;</span></label>
                                    <div class="accordion-item-bd">
                                        <h6 class="accordion-textm">Nemo enim ipsam volup tatem</h6>
                                        <p>Sodales quis.At vero eos et accusam et justo duo dolores et ea rebum. Lorem
                                            ipsum
                                            dolor sit ametLorem ipsum dolor sit amet,sed diam nonumy. Consectetur
                                            adipiscing
                                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <input class="accordion-item-input" type="checkbox" name="accordion"
                                        id="item5" />
                                    <label for="item5" class="accordion-item-hd">Vitae diam rutrum condimentum? <span
                                            class="accordion-item-hd-cta">&#9650;</span></label>
                                    <div class="accordion-item-bd">
                                        <h6 class="accordion-textm">Totam rem aperiam, eaque ipsa quae</h6>
                                        <p>Duo dolores et ea rebum. Lorem ipsum dolor sit ametLorem ipsum
                                            dolor sit amet,sed diam nonumy. Consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <input class="accordion-item-input" type="checkbox" name="accordion"
                                        id="item3" />
                                    <label for="item3" class="accordion-item-hd">Quos dolores et quas
                                        molestias excepturi sint?
                                        <span class="accordion-item-hd-cta">&#9650;</span></label>
                                    <div class="accordion-item-bd">
                                        <h6 class="accordion-textm">Sunt in culpa qui officia deserunt</h6>
                                        <p>sodales quis. At vero eos et accusam et justo duo dolores et ea rebum. Lorem
                                            ipsum dolor sit ametLorem ipsum dolor sit amet,sed diam nonumy. Consectetur
                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua.</p>
                                    </div>
                                </li>
                                <li class="accordion-item">
                                    <input class="accordion-item-input" type="checkbox" name="accordion"
                                        id="item4" />
                                    <label for="item4" class="accordion-item-hd">Dolores et quas molestias excepturi
                                        sint?<span class="accordion-item-hd-cta">&#9650;</span></label>
                                    <div class="accordion-item-bd">
                                        <h6 class="accordion-textm">Ut enim ad minim veniam, quis</h6>
                                        <p>Sodales quis at vero eos et accusam et justo duo dolores et ea rebum. Lorem
                                            ipsum
                                            dolor sit ametLorem ipsum dolor sit amet,sed diam nonumy. Consectetur
                                            adipiscing
                                            elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- //faq -->
@endsection
