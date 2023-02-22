@extends('layouts.layout')

@section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet"/>
    @endsection

    @section('content')
    <section class="container-fluid">
    @include('layouts.sidebar')

    <!-- mengirimkan routing ke routing web  -->
    <form action="{{ route('tweet') }}" method="post" class="main-tweet">
        @csrf
        <label>Add Tweet</label>
        <input type="hidden" name="id" value="{{ Auth::user()->id }}">
        <input type="text" name="tweet" id="tweet" placeholder="Write Something" required>
                    <div class= "wrap-checkbox">
                    <input type="checkbox" id="choice1" name="media" value="media">
                    <label for="choice1">Image</label>
                    </div>

                    <div id="form_media">
                        <input type="file" name="media" id="media" enctype="multipart/formdata" accept=".png, .jpg, .jpeg">
                    </div>
        <button type="submit">Tweet</button>
    
    </section>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
         
         $('#form_media').css('display', 'none');
         $('#choice1').on('change', function(){
            if(this.checked === true){
                return $('#form_media').css('display', 'block');
            }
            return $('#form_media').css('display', 'none');
         });

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
                    $('#tweet').html(data.tweet);
                    $('#media').html(data.media);
                    console.log(data);
                    // window.location.href = "http://127.0.0.1:8000/"
                }
            });
         })
    </script>

    @endsection