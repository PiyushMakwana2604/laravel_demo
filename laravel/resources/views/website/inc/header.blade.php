<?php
use Illuminate\Support\Facades\Route;

$currentAction = Route::currentRouteAction();

list($controller, $method) = explode('@', $currentAction);
// echo $method;
// die;
?>

<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="fa fa-close"></i>
    </div>
    <div class="canvas-search search-switch">
        <i class="fa fa-search"></i>
    </div>
    <nav class="canvas-menu mobile-menu">
        <ul>
            <li><a href="{{route('website.home-page')}}">Home</a></li>
            <li><a href="{{route('website.about-us')}}">About Us</a></li>
            <li><a href="{{route('website.class-details')}}">Classes</a></li>
            <li><a href="{{route('website.services')}}">Services</a></li>
            <li><a href="{{route('website.our-team')}}">Our Team</a></li>
            <li><a href="#">Pages</a>
                <ul class="dropdown">
                    <li><a href="{{route('website.about-us')}}">About us</a></li>
                    <li><a href="{{route('website.class-timetable')}}">Classes timetable</a></li>
                    <li><a href="{{route('website.bmi-calculator')}}">Bmi calculate</a></li>
                    <li><a href="{{route('website.our-team')}}">Our team</a></li>
                    <li><a href="{{route('website.gallery')}}">Gallery</a></li>
                    <li><a href="{{route('website.blog')}}">Our blog</a></li>
                    {{-- <li><a href="./404.html">404</a></li> --}}
                </ul>
            </li>
            <li><a href="{{route('website.contact-us')}}">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="canvas-social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-youtube-play"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
    </div>
</div>
<!-- Offcanvas Menu Section End -->


<header class="header-section">
      <div class="container-fluid">
          <div class="row">
              <div class="col-lg-3">
                  <div class="logo">
                      <a href="{{route('website.home-page')}}">
                          <img src="{{ asset('gym_assets/img/logo.png')}}" alt="">
                      </a>
                  </div>
              </div>
              <div class="col-lg-6">
                  <nav class="nav-menu">
                      <ul>
                          <li class="{{ $method === 'home_page' ? 'active' : '' }}"><a href="{{route('website.home-page')}}">Home</a></li>
                          <li class="{{ $method === 'about_us' ? 'active' : '' }}"><a href="{{route('website.about-us')}}">About Us</a></li>
                          <li class="{{ $method === 'class_details' ? 'active' : '' }}"><a href="{{route('website.class-details')}}">Classes</a></li>
                          <li class="{{ $method === 'services' ? 'active' : '' }}"><a href="{{route('website.services')}}">Services</a></li>
                          <li class="{{ $method === 'our_team' ? 'active' : '' }}"><a href="{{route('website.our-team')}}">Our Team</a></li>
                          <li class="{{ ($method === 'class_timetable' || $method === 'bmi_calculator' || $method === 'gallery' || $method === 'blog') ? 'active' : '' }}"><a>Pages</a>
                              <ul class="dropdown">
                                  <li><a href="{{route('website.about-us')}}">About us</a></li>
                                  <li class="{{ $method === 'class_timetable' ? 'active' : '' }}"><a href="{{route('website.class-timetable')}}">Classes timetable</a></li>
                                  <li class="{{ $method === 'bmi_calculator' ? 'active' : '' }}"><a href="{{route('website.bmi-calculator')}}">Bmi calculate</a></li>
                                  <li><a href="{{route('website.our-team')}}">Our team</a></li>
                                  <li class="{{ $method === 'gallery' ? 'active' : '' }}"><a href="{{route('website.gallery')}}">Gallery</a></li>
                                  <li class="{{ $method === 'blog' ? 'active' : '' }}"><a href="{{route('website.blog')}}">Our blog</a></li>
                                  {{-- <li><a href="./404.html">404</a></li> --}}
                              </ul>
                          </li>
                          <li class="{{ $method === 'contact_us' ? 'active' : '' }}"><a href="{{route('website.contact-us')}}">Contact</a></li>
                          <li class="{{ $method === 'hotspot' ? 'active' : '' }}"><a href="{{route('website.hotspot')}}">Hotspot</a></li>
                      </ul>
                  </nav>
              </div>
              <div class="col-lg-3">
                  <div class="top-option">
                      <div class="to-search search-switch">
                          <i class="fa fa-search"></i>
                      </div>
                      <div class="to-social">
                          <a href="#"><i class="fa fa-facebook"></i></a>
                          <a href="#"><i class="fa fa-twitter"></i></a>
                          <a href="#"><i class="fa fa-youtube-play"></i></a>
                          <a href="#"><i class="fa fa-instagram"></i></a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="canvas-open">
              <i class="fa fa-bars"></i>
          </div>
      </div>
  </header>