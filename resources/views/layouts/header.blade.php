<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
      <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <title>@stack('title')</title>
  </head>
  <body>
 
    <nav class="navbar navbar-expand-lg navbar-light theme-navbar">
        <div class="container-fluid">
          <a href="{{ url('/') }}"><img src="{{ asset('asset/images/logo/logo.png') }}" class="card-img-top" alt="..." style="width: 250px;">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div>
          
            <form class="d-flex">
              <div class="input-group">
                <input class="form-control" type="search"  aria-label="Search" style="width: 500px;" placeholder="Search for Product">
                <button class="btn btn-light btn-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
              
            </form>
            </div>
            <div>
                <a href="" class="text-decoration-none text-light">Become a Seller</a>
                <a href=""class="btn btb-sm theme-green-btn text-light"><i class="fa-solid fa-cart-shopping"></i>Cart</a>
                <a href=""class="btn btb-sm theme-orange-btn text-light"><i class="fa-solid fa-user"></i>Login</a>
            </div>
          
        </div>
      </nav>
    {{--  Category Nav  --}}
    <nav class="navbar navbar-expand-lg theme-navbar-light">
      <div class="container-fluid">
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link  text-dark"href="{{ url('category/electronics') }}" >Mobile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark"href="#">Fashions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  text-dark"href="#">Electronics</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark"href="#">Furniture</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark"href="#">Grocery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-dark"href="{{ url('category/electronics/tv') }}">Appliences</a>
            </li>
        </div>
      </div>
    </nav>