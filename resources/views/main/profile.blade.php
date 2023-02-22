@extends('layouts.layout')

@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="{{ url('css/main.css') }}" rel="stylesheet"/>
    @endsection

    @section('content')
    <section class="container-fluid">
    @include('layouts.sidebar')

    <!-- membuat kondisi dimana jika user tidak/belum membuat profile
    maka, akan di jalankan kondisi if pertama
    dan jika tidak maka akan dijalankan kondisi kedua -->

    <section class="main-profile">
    <div class="container-profile">
    @if(Auth::user()->media == null)
                  <span class="circle-profile">
                    <p>{{ substr(Auth::user()->name  , 0 ,1) }}</p>
                  </span> 
                  @else 
                  <div class="circle-profiles">
                      <img src="{{ asset('storage/profile_media/' . Auth::user()->media) }}">
        </div>
            @endif

            
    </div>
    <div class="wrap-profile">
        <div class="wrap-name">
        <label>{{ Auth::user()->name }}</label>
        <p>{{ Auth::user()->username }}</p>
        </div>

        <div class="wrap-button">
            <a href="/editProfile">Edit Profile</a>
        </div>

    </div>
    <div class="wrap-bio">
    @if(Auth::user()->bio == null)
        <p>Bio Belum Di buat</p>
    @else
        <p>{{ Auth::user()->bio }}</p>
    @endif
    <p>Di buat pada {{ Auth::user()->created_at }}</p> 
    </div>


        <section class="third-content">
        <div class="for-content">
        <div class="wrap-account">
            @if($tweet_detail_all->media == null)
            <span class="second-circle">
                    <p>{{ substr($tweet_detail_all->name  , 0 ,1) }}</p>
            </span> 
            @else
            <div class="second-circles">
                      <img src="{{ asset('storage/profile_media/' . $tweet_detail_all->media) }}">
        </div>
            @endif
        
        <div class="third-wrap">
            <label>{{ $tweet_detail_all->name }}</label>
            <span>{{ $tweet_detail_all->username }}</span>
        </div>
    </div>
    @foreach($tweet_detail_all->tweet as $loop_tweet)
    <form action="{{ route('updateTweet') }}" method= "GET">
        @csrf
        <input type="hidden" name="id_update" value="{{ $loop_tweet->id }}">
        <button type="submit">Edit</a>
    </form>
    <form action="{{ route('deleteTweet') }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $loop_tweet->id }}">
    <button type="submit">Delete</button>
    </form>
        <p class="only-text">{{ $loop_tweet->tweet }}</p>

        @if($loop_tweet->media != null)
            <img class="img-thumbnail" src="{{ asset('storage/tweet_media/' . $loop_tweet->media) }}" alt="" />
        @endif
                </div>
        @endforeach

    </section>
        




    </section>

    </section>
    @endsection