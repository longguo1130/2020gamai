@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/about.css') }}" rel="stylesheet">
    <div class="container">
        <div class="row">
            <div class="about-header">
                <h1>Hi, we are Gamai</h1>
                <h5>We are Gamai PH, a team that</h5>
                <h5>loves to learn, collaborate and create</h5>
            </div>
        </div>
        <div class="row" style="margin-bottom: 100px;">
            <div class="col-lg-5 col-12 about-image">
                <img src="{{asset('assets/mission.png')}}" alt="">
            </div>
            <div class="col-lg-7 col-12">
                <h2 style="text-align: center; padding: 20px;">Our Mission</h2>
                <h4>
                    We create opportunities for people that empower them to reach their goal faster.
                </h4>
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
            <div class="row member-image" style="text-align: center">
                <div class="col-lg-3 col-12"><img src="{{asset('avatars/ceo.jpg')}}" alt=""><p  style="margin-bottom: -10px">Ian Oliver Atendido II</p><p>FOUNDER/CEO</p></div>
                <div class="col-lg-3 col-12"><img src="{{asset('avatars/cfo.jpg')}}" alt=""><p  style="margin-bottom: -10px">Bless Christine Atendido</p><p>BUSINESS CONSULTANT</p></div>
                <div class="col-lg-3 col-12"><img src="{{asset('avatars/cto.jpg')}}" alt=""><p  style="margin-bottom: -10px">Bienvenido Siton Amodia Jr.</p><p>QUALITY CONTROL AND ADMIN </p></div>
                <div class="col-lg-3 col-12"><img src="{{asset('avatars/coo.jpg')}}" alt=""><p  style="margin-bottom: -10px">LONGGUO JIN</p><p>Senior Developer</p></div>
            </div>
        </div>
    </div>
@endsection
