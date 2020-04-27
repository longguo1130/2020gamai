@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="about-header">
                <h2>Welcome to Gamai Support Center</h2>
                <h5>What are you looking for?</h5>
                <form id="product-search-form" action="{{ route('home') }}" method="GET" style="">
                    <div class="document-search">
                        <input type="text" name="q" class="navbar-search" placeholder="Search our Documentation" value="{{ $query }}">
                        <i class="fa fa-search"></i>
                    </div>
                </form>

            </div>
        </div>
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-lg-3 col-12 support-image">
                <img src="{{asset('assets/Asset 21@4x.png')}}" alt="">
                <h5>Introduction</h5>
            </div>
            <div class="col-lg-3 col-12 support-image">
                <img src="{{asset('assets/Asset 21@4x.png')}}" alt="">
                <h5>Introduction</h5>
            </div>
            <div class="col-lg-3 col-12 support-image">
                <img src="{{asset('assets/Asset 21@4x.png')}}" alt="">
                <h5>Introduction</h5>
            </div>
            <div class="col-lg-3 col-12 support-image">
                <img src="{{asset('assets/Asset 21@4x.png')}}" alt="">
                <h5>Introduction</h5>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-7 col-12">
                <h2 style="text-align: center; padding: 20px;">Our Vision</h2>
                <h4>
                    To be the go to technology company that people depend on to provide them opportunities that bring them closer to their dreams.

                </h4>
            </div>
            <div class="col-lg-5 col-12 about-image">
                <img src="{{asset('assets/vision.png')}}" alt="">
            </div>

        </div>
        <div class="row">
            <div class="about-header">
                <h1>Our Team</h1>
                <h5>We are Gamai PH, a team that</h5>
                <h5>loves to learn, collaborate and create</h5>

            </div>

        </div>
        <div class="row member-image" style="text-align: center">
            <div class="col-lg-3 col-12"><img src="{{asset('assets/default.png')}}" alt=""></div>
            <div class="col-lg-3 col-12"><img src="{{asset('assets/default.png')}}" alt=""></div>
            <div class="col-lg-3 col-12"><img src="{{asset('assets/default.png')}}" alt=""></div>
            <div class="col-lg-3 col-12"><img src="{{asset('assets/default.png')}}" alt=""></div>
        </div>
    </div>
@endsection
