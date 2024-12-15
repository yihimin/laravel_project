<!DOCTYPE html>
<html lang="ko">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Brew & Carry</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('my/images/favicon.ico') }}" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('my/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body>
        
<!-- Navigation -->
@include('main.partials.navbar')

<!-- Header -->
<header class="bg-light py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center">
            <h1 class="display-4 fw-bolder" style="color: #6c4c41;">Brew & Carry</h1>
            <p class="lead fw-normal" style="color: #8e8e8e;">Find the perfect coffee cups and tumblers for your daily brew.</p>
        </div>
        <div class="text-center mt-4">
            <img src="{{ asset('my/images/coffee_banner.jpg') }}" alt="Coffee Cups and Tumblers" class="img-fluid" style="max-height: 300px; border-radius: 15px; object-fit: cover;">
        </div>
    </div>
</header>