@extends('layouts.layout')

@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet"/>
    @endsection

    
    
    @section('content')
    <section class="container-fluid">
    @include('layouts.sidebar')

    <section class="main-content">
        <div class="label-text">
            <label>For You</label>
            <span>Posts</span>
        </div>
        <!-- menggunakan looping supaya dapat menampilkan semua data -->
        @foreach($tweet as $loop_tweet)
        <div class="for-content">
        <div class="wrap-account">
        @if($loop_tweet->user != null && $loop_tweet->user->media != null)
            <div class="second-circles">
                      <img src="{{ asset('storage/profile_media/' . $loop_tweet->user->media) }}">
        </div>
            @else
            <span class="second-circle">
                    <p>{{ substr($loop_tweet->user->name  , 0 ,1) }}</p>
            </span> 
            @endif
        
        <div class="third-wrap">
            <label>{{ $loop_tweet->user->name }}</label>
            <span>{{ $loop_tweet->user->username }}</span>
        </div>
        </div>
        <p class="only-text">{{ $loop_tweet->tweet }}</p>
        
        <p>{{ $loop_tweet->tag != null ? '#' . $loop_tweet->tag : '' }}</p>

@if($loop_tweet->media != null && $loop_tweet->media != "")
    <img class="img-thumbnail" src="{{ asset('storage/tweet_media/' . $loop_tweet->media) }}" alt="" />
@endif
        </div>
        <a href="http://127.0.0.1:8000/comment/{{ $loop_tweet->id }}">Comment</a>
        @endforeach


    </section>
    
    @include('layouts.search')

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</script>
@endsection

