@extends('layouts.layout')

@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet"/>
    @endsection

    <!-- tampilan utama atau main di gunakan dan memakai extends layout agar lebih mudah dilihat
dan terstruktur rapi -->

    @section('content')
    <section class="container-fluid">
    @include('layouts.sidebar')

    <!-- mengirimkan routing kepada routing web -->

    <form action="{{ route('profileUpdate') }}" method="post" class="main-tweet">
        @csrf
        <label>Edit Profile</label>
        <input type="hidden" name="id_update" id="id_update" placeholder="Nama" value="{{ Auth::user()->id }}">
        <input type="text" name="name_update" id="name_update" placeholder="Nama" value="{{ Auth::user()->name }}">
        <input type="text" name="username_update" id="username_update" placeholder="username" class="form-input" value="{{ Auth::user()->username }}">
        <input type="text" name="bio" id="bio" placeholder="Your Bio">
        <input type="file" name="media" id="media" enctype="multipart/formdata" accept=".png, .jpg, .jpeg">
        <button type="submit">Confirm</button>
    </form>
    
    </section>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>

         $(document).on('submit', '.main-tweet', function(e){
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:$(this).attr('action'),
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false, 
                beforeSend:function(){},
                success:function(data) {
                    $('#name_update').html(data.name_update);
                    $('#name_update').html(data.username_update);
                    $('#bio').html(data.bio);
                    $('#media').html(data.media);
                    window.location.href = "http://127.0.0.1:8000/profile"
                }
            });
         })
    </script>

    @endsection