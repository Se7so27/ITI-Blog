@extends('layouts.app')

@section ('title','Home')

@section('content')
    <div id="homeSlider" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/images/slide1.png') }}" class="d-block w-100" style="height:400px; object-fit:cover;" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/images/slide2.jpeg') }}" class="d-block w-100" style="height:400px; object-fit:cover;" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/images/slide3.jpeg') }}" class="d-block w-100" style="height:400px; object-fit:cover;" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <h2>Welcome to ITIBlog</h2>
    <p>A blog built with Laravel.</p>
@endsection
