@extends('web_layout.main')
@section('content')
    <!-- inner banner -->
    <section class="w3l-inner-banner-main">
        <div class="about-inner inner2">
            <div class="container seen-w3">
                <h3 class="inner-title">Contact Us</h3>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="/">Home</a></li>
                    <li><span class="fa fa-angle-right" aria-hidden="true"></span></li>
                    <li class="active">Contact</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
    <!-- contact block -->
    <section class="w3l-contacts-12 pt-5">
        {{-- <div class="contact-top py-md-3">
            <div class="container">
                <div class="contacts12-main">
                    <h3 class="title-main title-2">Get In Touch</h3>
                    <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In posuere varius
                        diam, commodo
                        dictum massa convallis at.</p>
                    <form action="#" method="post" class="main-input">
                        <div class="top-inputs d-grid">
                            <input type="text" placeholder="Name" name="w3lName" id="w3lName" required="">
                            <input type="email" name="email" placeholder="Email" id="w3lSender" required="">
                        </div>
                        <input type="text" placeholder="Phone Number" name="w3lName" id="w3lName" required="">
                        <textarea placeholder="Message" name="w3lMessage" id="w3lMessage" required=""></textarea>
                        <div class="d-flex">
                            <button type="subnmit" class="button raised hoverable  ml-auto">
                                <div class="anim"></div><span>Send Message</span>
                            </button>
                        </div>
                    </form>
                    <div class="contact mt-md-4 mt-5">
                        <p class="contact-text-sub">United State,</p>
                        <p class="contact-text-sub">75 West Rock, {{ config('company.company_address') }}</p>
                        <a href="mailto:{{ config('company.company_email') }}">
                            <p class="contact-text-sub">{{ config('company.company_email') }}</p>
                        </a>
                        <a href="tel:{{ config('company.company_number') }}">
                            <p class="contact-text-sub">+1 {{ config('company.company_number') }}</p>
                        </a>
                        <div class="buttons-teams">
                            <a href="#team"><span class="fa fa-facebook-square" aria-hidden="true"></span></a>
                            <a href="#team"><span class="fa fa-instagram" aria-hidden="true"></span></a>
                            <a href="#team"><span class="fa fa-youtube" aria-hidden="true"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="contact-top py-md-3">
            <div class="container">
                <div class="row contacts12-main">

                    <div class="col-md-6 col-12 d-flex align-items-center">
                        <div class="contact-info w-100">

                            <p class="contact-text-sub">
                                <span class="fa fa-map-marker mr-2 text-primary" aria-hidden="true"></span>
                                75 West Rock, {{ config('company.company_address') }}
                            </p>

                            <p class="contact-text-sub">
                                <a href="mailto:{{ config('company.company_email') }}">
                                    <span class="fa fa-envelope mr-2 text-danger" aria-hidden="true"></span>
                                    {{ config('company.company_email') }}
                                </a>
                            </p>

                            <p class="contact-text-sub">
                                <a href="tel:{{ config('company.company_number') }}">
                                    <span class="fa fa-phone mr-2 text-success" aria-hidden="true"></span>
                                    +1 {{ config('company.company_number') }}
                                </a>
                            </p>

                            <div class="buttons-teams mt-3">
                                <a href="#"><span class="fa fa-facebook-square fa-2x mr-2 text-primary"
                                        aria-hidden="true"></span></a>
                                <a href="#"><span class="fa fa-instagram fa-2x mr-2 text-danger"
                                        aria-hidden="true"></span></a>
                                <a href="#"><span class="fa fa-youtube fa-2x text-danger"
                                        aria-hidden="true"></span></a>
                            </div>
                        </div>
                    </div>
                    {{-- Left side: Contact Form --}}
                    <div class="col-md-6 col-12 mb-4">
                        <h3 class="title-main title-2">Get In Touch</h3>
                        <p class="sub-title">
                            Have questions or need assistance? Fill out the form and we’ll get back to you shortly.
                        </p>
                        <form action="#" method="post" class="main-input">
                            <div class="top-inputs d-grid">
                                <input type="text" placeholder="Name" name="w3lName" id="w3lName" required="">
                                <input type="email" name="email" placeholder="Email" id="w3lSender" required="">
                            </div>
                            <input type="text" placeholder="Phone Number" name="w3lPhone" id="w3lPhone" required="">
                            <textarea placeholder="Message" name="w3lMessage" id="w3lMessage" required=""></textarea>
                            <div class="d-flex">
                                <button type="submit" class="button raised hoverable ml-auto">
                                    <div class="anim"></div><span>Send Message</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Right side: Contact Info --}}

                </div>
            </div>
        </div>


        <div class="map mt-5">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d158858.47340002653!2d-0.24168120642536509!3d51.52855824164916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C+UK!5e0!3m2!1sen!2sin!4v1562822037850!5m2!1sen!2sin"
                width="100%" height="400" frameborder="0" style="border:0; display:block;" allowfullscreen></iframe>
        </div>
    </section>
    <!-- //contact block -->
    <div class="display-ad" style="margin: 8px auto; display: block; text-align:center;">
        <!---728x90--->
    </div>
@endsection
