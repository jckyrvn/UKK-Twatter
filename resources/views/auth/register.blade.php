@extends('layouts.layout')

    @section('link')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet"/>
    @endsection

    @section('content')
    <!-- membuat form register dan mengirimkan ke route web -->
    <form class="form-register" action="{{ route('register') }}" method="POST">
        @csrf
        <img src="{{ asset('images/logo.png') }}" class="img-logo">
        @if ($errors->any())
        <div class="error">
            <!-- validasi view error -->
        @foreach ($errors->all() as $message)
            <p>{{ $message }}</p>
        @endforeach
        </div>
        @endif
        <input type="text" name="name" id="name" class="form-input" placeholder="Nama Pengguna">
        <input type="text" name="username" id="username" class="form-input" placeholder="@username">
        <input type="email" name="email" id="email" class="form-input" placeholder="Email">
        <input type="password" name="password" id="password" class="form-input" placeholder="Password">
        <button type="submit" onClick=""><span>Register</span></button>
        <p>Already have an account? <a href="{{ url('/login') }}">Login</a></p>
    </form>

    @endsection
