@extends('layouts.layout')

@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="{{ url('css/main.css') }}" rel="stylesheet"/>
    @endsection

<!-- tampilan utama atau main di gunakan dan memakai extends layout agar lebih mudah dilihat
dan terstruktur rapi -->

    @section('content')
    <section class="container-fluid">
    @include('layouts.sidebar')

        <!-- {{ $tweet_detail_all->user->name }} -->
        <section class="second-content">
        <div class="for-content">
        <div class="wrap-account">
            @if($tweet_detail_all == null)
            <span class="second-circle">
                    <p>{{ substr($tweet_detail_all->user->name  , 0 ,1) }}</p>
            </span> 
            @else
            <div class="second-circles">
                      <img src="{{ asset('storage/profile_media/' . $tweet_detail_all->user->media) }}">
        </div>
            @endif
        
        <div class="third-wrap">
            <label>{{ $tweet_detail_all->user->name }}</label>
            <span>{{ $tweet_detail_all->user->username }}</span>
        </div>
        </div>
        <p class="only-text">{{ $tweet_detail_all->tweet }}</p>

@if($tweet_detail_all->media != null)
    <img class="img-thumbnail" src="{{ asset('storage/tweet_media/' . $tweet_detail_all->media) }}" alt="" />
@endif



    <div class="caption">
        @foreach($tweet_detail_all->comment as $loop_detail) 
        
        @if($loop_detail == null)
            <span class="caption-circle">
                    <p>{{ substr($loop_detail->user->name  , 0 ,1) }}</p>
            </span> 
            @else
            <div class="caption-circles">
                      <img src="{{ asset('storage/profile_media/' . $loop_detail->user->media) }}">
        </div>
            @endif

        <label>{{ $loop_detail->user->name }}</label>
        <p>{{ $loop_detail->comments }}</p>


        @endforeach
    </div>


    <form action="{{ url('comment') }}/{{ $id }}" method="POST" class="main-tweet">
        @csrf
        <input type="hidden" value="{{ $id }}" name="user_id" id="user_id">
        <input type="text" name="comments" id="comments" placeholder="Comment" required>
        <button type="submit">Comment</button> 
    </form>
@if()
<div clas>
    <form action="{{ url('updateComment') }}/{{$id}}" method="POST" class="main-tweet">
        @csrf
    <input type="hidden" value="{{ $id }}" name="user_id" id="user_id">
    <input type="text" name="comments_update" id="comments_update" placeholder="Comment" required>
    <button type="submit">Update</button> 
    ]</form>
</div>
@endif
    

</section>
    </section>
    @endsection
    