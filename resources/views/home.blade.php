
@extends('layouts.main')
@section('content')
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('asset/images/slider1.png') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('asset/images/slider2.png') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('asset/images/slider3.png') }}" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('asset/images/slider4.png') }}" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
{{--  product section  --}}
  <section class="my-5">
   
    
      <div class="container"> 
        <div class="d-flex bd-highlight mb-3">
          <div class="me-auto bd-highlight"> 
            <h2>Top Deals</h2>
          </div>
          <div class="p-2 bd-highlight">
            <a href="#"class="btn btn-sm theme-green-btn text-light">View All</a></div>
          
        </div>
                 
             
          <div class="row theme-product">
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/1.jpg') }}" class="card-img-top" alt="..."></a>
                    <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Campus Shoes</a></h6>
                    <h5 class="card-title text-center">₹  4,999</h5>
                </div>
              </div>
          </div>
              <div class="col-md-3">
                  <div class="card">
                    <div class="card-body">
                      <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/2.jpg') }}" class="card-img-top" alt="..."></a>
                        <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Apple Watch</a></h6>
                        <h5 class="card-title text-center">₹  47,999</h5>
                    </div>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/3.jpg') }}" class="card-img-top" alt="..."></a>
                      <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Nike Cap</a></h6>
                      <h5 class="card-title text-center">₹  2,999</h5>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <a href="#" class="text-decoration-none"><img src="{{ asset('asset/images/products/4.jpg') }}" class="card-img-top" alt="..."></a>
                    <h6 class="card-title text-center text-dark"> <a href="#"class="text-decoration-none ">Wooden Chair</a></h6>
                    <h5 class="card-title text-center">₹  14,999</h5>
                </div>
              </div>
              </div>
          </div>
  </section>

  {{--  Recently Viewed  --}}
  <section class="my-5">
   
    
    <div class="container"> 
      <div class="d-flex bd-highlight mb-3">
        <div class="me-auto bd-highlight"> 
          <h2>Recently Viewed</h2>
        </div>
        <div class="p-2 bd-highlight">
          <a href="#"class="btn btn-sm theme-orange-btn text-light">View All</a></div>
        
      </div>
               
           
        <div class="row theme-product">
          <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/5.jpg') }}" class="card-img-top" alt="..."></a>
                  <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Camera Shoes</a></h6>
                  <h5 class="card-title text-center">₹ 84,999</h5>
              </div>
            </div>
        </div>
            <div class="col-md-3">
                <div class="card">
                  <div class="card-body">
                    <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/6.jpg') }}" class="card-img-top" alt="..."></a>
                      <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Shoes</a></h6>
                      <h5 class="card-title text-center">₹ 2,999</h5>
                  </div>
                </div>
            </div>
            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/7.jpg') }}" class="card-img-top" alt="..."></a>
                    <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Television</a></h6>
                    <h5 class="card-title text-center">₹ 92,999</h5>
                </div>
              </div>
            </div>
            <div class="col-md-3">
            <div class="card">
              <div class="card-body">
                <a href="#" class="text-decoration-none"><img src="{{ asset('asset/images/products/8.jpg') }}" class="card-img-top" alt="..."></a>
                  <h6 class="card-title text-center text-dark"> <a href="#"class="text-decoration-none "> Washing Machine</a></h6>
                  <h5 class="card-title text-center">₹ 14,999</h5>
              </div>
            </div>
            </div>
        </div>
</section>
@endsection