@extends('layouts.template')

@section('content')
<header class="masthead" style="background-image: url('{{asset('clean-blog/assets/img/post-bg.jpg')}}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>Man must explore, and this is exploration at its greatest</h1>
                    <h2 class="subheading">Problems look mighty small from 150 miles up</h2>
                    <span class="meta">
                        Posted by
                        <a href="#!">Start Bootstrap</a>
                        on August 24, 2023
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>


@if($post)

    <h2>{{$post->subject}}</h2>
    <span style="float:right;">{{$post->publish_date?->format('d/m/Y')}}</span>
    <br/>
    <img src="{{asset($post->image)}}" width="400px">

    <p>{{$post->text}}</p>

@endif

@endsection