@extends('web_layout.main')
@section('content')
    <section class="w3l-inner-banner-main">
        <div class="about-inner inner2">
            <div class="container seen-w3">
                <h3 class="inner-title">Our Services</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index-2.html">Home</a></li>
                    <li><span class="fa fa-angle-right" aria-hidden="true"></span></li>
                    <li class="active">Services</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <!-- services block -->
    <section class="w3l-services-1">
        <div class="services1">
            <div class="container">
                <div class="heading text-center mx-auto">
                    <h3 class="head">Explore Our Main Services </h3>
                    <p class="my-3 head">When disaster strikes, you can count on us. We provide comprehensive restoration
                        services for hail, wind, leaks, water damage, and emergency situations. From emergency tarping to
                        full-scale storm recovery and insurance claim assistance, our goal is to restore not just your
                        property but also your peace of mind.</p>
                </div>
                <div class="row services1-content mt-5">
                    @foreach ($get_all_services as $service_data)
                        <div class="col-md-6 column mt-3 mb-4">
                            {{-- <a href="{{ route('portfolio') }}">
                                @if ($service_data->media)
                                    <img class="img-fluid img-responsive" src="{{ $service_data->media->file_path }}"
                                        alt="{{ $service_data->service_name }}">
                                @endif
                                <div class="service-info">
                                    <h4>{{ $service_data->service_name }}</h4>
                                    <p>{{ \Illuminate\Support\Str::limit($service_data->service_title, 65) }}</p>
                                </div>
                            </a> --}}
                            <x-service-card :route="route('portfolio')" :is_media="$service_data->media" :media_path="$service_data->media->file_path" :service_name="$service_data->service_name"
                                :service_title="$service_data->service_title" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- //services block -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <!-- features -->
    <div class="w3l-index-block4 py-5">
        <div class="features-bg py-md-5" style="background-color: #f5fcff;">
            <!-- features15 block -->
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
                        <x-why-choose-us-web :card_bg_color="'#fff'" :cta="route('about_us')" :wcu_icon="$get_wcu_data->icon" :title="$get_wcu_data->title"
                            :description="$get_wcu_data->description" />
                    @empty
                        <div class="col-12">
                            <p class="p-5 text-center text-dark head"> No Services Found. </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    @endsection
@endsection
