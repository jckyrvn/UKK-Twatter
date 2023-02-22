
@extends('layouts.layout')

    @section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet"/>
    @endsection

    @section('content')
    <!--membuat form dan memanggil route login ke routing web -->
    <form class="form-login" action="{{ route('login') }}" method="POST">
        @csrf
        <img src="{{ asset('images/logo.png') }}" class="img-logo">
       
       <!-- validasi view error -->
        @if ($errors->any())
        <div class="error">
        @foreach ($errors->all() as $message)
            <p>{{ $message }}</p>
        @endforeach
        </div>
        @endif
        <input type="email" name="email" id="email" class="form-input" placeholder="Email">
        <input type="password" name="password" id="password" class="form-input" placeholder="Password">
        <button type="submit" onClick=""><span>Login</span></button>
        <p>Doesn't have an account? <a href="{{ url('/register') }}">Register</a></p>
    </form>

    @endsection
