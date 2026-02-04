@extends('web_layout.main')
@section('content')
    <!-- inner banner -->
    <section class="w3l-inner-banner-main">
        <div class="about-inner inner2">
            <div class="container seen-w3">
                <h3 class="inner-title">About Us</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="/">Home</a></li>
                    <li><span class="fa fa-angle-right" aria-hidden="true"></span></li>
                    <li class="active">About Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->
    <!-- about block 1 -->
    <section class="w3l-about py-5" id="about">
        <div class="about-bottom py-md-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 pr-xl-4">
                        <p class="css-typing sub-title-top text-bl mb-3">Welcome To Our Legacy Remodeling !</p>
                        <h3 class="title-w3-ab"><span>Make a strong first impression</span> guide visitors toward contacting
                            you
                            Excellent
                            Work!
                        </h3>
                    </div>
                    <div class="col-lg-6 offset-lg-1 pr-lg-4 mt-lg-0 mt-4 about-right-mo">
                        <p>At {{ env('APP_NAME') }}, we take pride in being your one-stop solution for home improvement,
                            repair, and restoration needs. Whether it’s protecting your roof, upgrading your siding,
                            installing gutters, or restoring your home after unexpected damage, our team is here to deliver
                            reliable results with unmatched craftsmanship.</p>


                        <p class="mt-4">We understand that your home is more than just a place — it’s your safe space,
                            your investment, and your comfort zone. That’s why every service we provide is designed to
                            protect, beautify, and strengthen your property for years to come.
                        </p>
                        <p>With skilled professionals, quality materials, and a customer-first approach, we make sure every
                            project — big or small — is handled with precision and care. From routine inspections to
                            emergency restorations, we’ve got the expertise to bring peace of mind back to your home.</p>
                        </p>
                        <a href="{{ route('contact_us') }}" class="button raised hoverable btn">
                            <div class="anim"></div><span>Contact Now</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- //about block 1 -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <!-- about block 3 -->
    <section class="about-block-3 py-5" style="background: #f5fcff;">
        <div class="grids-w3ovt py-md-3" id="what">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3 pr-xl-4">
                        <h2 class="title-w3-ab"><span>Why Choose <strong>Us</strong>!</span>
                            </h3>
                    </div>
                    <div class="col-12 col-md-9"></div>

                    <div style="clear: both"></div>
                    @forelse ($get_wcu as $key=>$get_wcu_data)
                        <x-why-choose-us-card-v2 :icon="$get_wcu_data->icon" :row_no="$key + 1" :step="'Step ' . ($key + 1)" :title="$get_wcu_data->title"
                            :description="$get_wcu_data->description" />
                    @empty
                        <div class="col-12">
                            <p class="p-5 text-center text-dark head"> No Services Found. </p>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </section>
    <!-- //about block 3 -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <section class="about-block-section" style="background: #ffff;">
        <div class="slider-effest  py-5" id="latest" style="background: #ffff !important;">
            <div class="container  py-md-3">
                <div class="row">
                    <div class="col-md-6 pr-lg-5">
                        <div class="midd-slider">
                            <div class="csslider infinity" id="slider1">
                                <input type="radio" name="slides" checked="checked" id="slides_1" />
                                <input type="radio" name="slides" id="slides_2" />
                                <input type="radio" name="slides" id="slides_3" />
                                <input type="radio" name="slides" id="slides_4" />
                                <ul>
                                    @foreach ($get_all_services as $get_all_services_photo)
                                        <li>
                                            <div class="slider-info">
                                                <img src="{{ $get_all_services_photo->media->file_path }}" alt=""
                                                    class="img-fluid" />
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                                <div class="navigation">
                                    <div>
                                        <label for="slides_1"></label>
                                        <label for="slides_2"></label>
                                        <label for="slides_3"></label>
                                        <label for="slides_4"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-lg-0 mt-5 pt-lg-0 pt-2">
                        <p class="sub-title-top text-bl mb-lg-3 mb-1">Our Mission and Vision</p>
                        <h3 class="title-w3-ab mb-3">Explore Premium Services</h3>
                        <p class="mt-lg-4">We are committed to improving our community one roof at a time by delivering
                            durable, trusted, and efficient roofing and restoration services. The best compliment for our
                            business is a repeat customer, and we strive to provide every client with transparency,
                            integrity, and exceptional quality.</p>
                        <a href="{{ route('portfolio') }}" class="button raised hoverable btn">
                            <div class="anim"></div><span>Our Portfolio</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- team block -->
    <section class="w3l-team py-5" style="background: #f5fcff;">
        <div class="sub-team py-md-3">
            <div class="container">
                <div class="heading text-center mx-auto">
                    <h3 class="head">Our Services </h3>
                    <p class="my-3 head"> Estibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                        cubilia Curae
                        Nulla mollis dapibus nunc, ut rhoncus
                        turpis sodales quis.</p>
                </div>
                <div class="row inner-sec-w3layouts mt-md-5 mt-4">
                    @forelse ($get_all_services as $get_all_services_data)
                        <x-our-services-v2 :card_icon_class="$get_all_services_data->icon_class" :card_route="route('services', $get_all_services_data->slug)" :card_name="$get_all_services_data->service_name" :card_title="$get_all_services_data->service_description" />
                    @empty
                        <div class="col-12">
                            <p class="p-5 text-center text-dark head"> No Services Found. </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    <!-- team block -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
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
