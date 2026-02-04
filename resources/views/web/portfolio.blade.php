@extends('web_layout.main')
@section('content')
    <!-- inner banner -->
    <section class="w3l-inner-banner-main">
        <div class="about-inner inner2">
            <div class="container seen-w3">
                <h3 class="inner-title">Portfolio</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="#">Home</a></li>
                    <li><span class="fa fa-angle-right" aria-hidden="true"></span></li>
                    <li class="active">Portfolio</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <!-- portfolio1 -->
    <section class="w3l-portfolios-1">
        <div class="portfolio1">
            <div class="container">
                <h3 class="title-main">Our Portfolio</h3>
                <p class="sub-title">At the heart of our work lies a passion for quality, innovation, and client
                    satisfaction. Our portfolio showcases a diverse range of successful projects that highlight our
                    expertise in Roofing, Siding, Gutters, and Restoration, as well as other custom solutions for both
                    residential and commercial properties.</p>
                {{-- <div class="row portfolio1-content">
                    <div class="col-md-6 column1 pr-md-0 hover-grid">
                        <a href="#">
                            <img src="/assets/images/portfolio2.jpg" alt="" class="img-fluid" />
                        </a>
                    </div>
                    <div class="col-md-6 column2 mt-md-0 mt-4 pr-md-0">
                        <div class="row portfolio1-content1">
                            <div class="col-6 column3 pr-md-0 hover-grid">
                                <a href="#">
                                    <img src="/assets/images/portfolio2.jpg" alt="" class="img-fluid" />
                                </a>
                            </div>
                            <div class="col-6 column4  pr-md-0 hover-grid">
                                <a href="#">
                                    <figure><img src="/assets/images/portfolio3.jpg" alt="" class="img-fluid" />
                                </a>
                            </div>
                        </div>
                        <div class="row portfolio1-content1 mt-3">
                            <div class="col-6 column5 pr-md-0 hover-grid">
                                <a href="#">
                                    <img src="/assets/images/portfolio4.jpg" alt="" class="img-fluid" />
                                </a>
                            </div>
                            <div class="col-6 column6  pr-md-0 hover-grid">
                                <a href="#">
                                    <img src="/assets/images/portfolio5.jpg" alt="" class="img-fluid" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="container my-4">
                    <div class="row g-3">
                        @foreach ($portfolio_images as $index => $img)
                            @if ($index % 5 == 0)
                                <div class="col-md-6 p-2">
                                    <a href="#">
                                        <img src="{{ asset($img->file_path) }}" alt="Main Image"
                                            class="img-fluid w-100 h-100" style="object-fit: cover; border-radius: 8px;" />
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
    <!-- //portfolio1 -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>

    <!-- blog block -->
    {{-- <section class="w3l-services-6">
        <div class="services-layout">
            <div class="container">
                <h3 class="title-main">Some of our complete work</h3>
                <p class="sub-title">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex
                    ea commodo consequat.</p>
                <div class="row">
                    <div class="col-md-4 column column-img" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">21<sup>st</sup> October</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image1.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Nunc consequat justo id commodo feugiat</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o" aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column column-img my-md-0 my-4" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">23<sup>rd</sup> October</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image2.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Fusce ac eros quis metus por edit some</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o" aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column column-img" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">1<sup>st</sup> November</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image3.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Cras fringilla, enim a porta fermentum</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o"
                                                aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-lg-4 my-md-2">
                    <div class="col-md-4 column column-img my-md-0 my-4" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">4<sup>th</sup> November</h3>

                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image4.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Cras fringilla, enim a porta fermentum</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o"
                                                aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column column-img" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">7<sup>th</sup> November</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image5.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Fusce ac eros quis metus por edit some</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o"
                                                aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column column-img my-md-0 my-4" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">15<sup>th</sup> November</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image7.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Nunc consequat justo id commodo
                                        feugiat</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o"
                                                aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 column column-img" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">21<sup>st</sup> December</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image6.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Nunc consequat justo id commodo
                                        feugiat</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o"
                                                aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column column-img my-md-0 my-4" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">23<sup>rd</sup> December</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image8.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Fusce ac eros quis metus por edit some</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o"
                                                aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 column column-img" id="zoomIn">
                        <div class="services-gd">
                            <div class="serve-info">
                                <h3 class="date">25<sup>th</sup> December</h3>
                                <a href="blog-single.html">
                                    <figure>
                                        <img class="img-responsive" src="assets/images/image9.jpg" alt="blog-image">
                                    </figure>
                                </a>
                                <h3> <a href="blog-single.html" class="vv-link">Cras fringilla, enim a porta fermentum</a>
                                </h3>
                                <ul class="admin-list">
                                    <li><a href="blog-single.html"><span class="fa fa-user" aria-hidden="true"></span>
                                            Admin</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-heart-o"
                                                aria-hidden="true"></span>6
                                            Likes</a></li>
                                    <li><a href="blog-single.html"><span class="fa fa-commenting-o"
                                                aria-hidden="true"></span>9 Review</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <nav aria-label="...">
                    <ul class="pagination mt-5">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section> --}}
    <!-- //blog block -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
@endsection
