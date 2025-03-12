@extends('layouts.main')
@push('title')
Category
@endpush
@section('content')
<div class="container-fluid bg-light p-5">
    <h1 class="text-center"><i class="fa-solid fa-layer-group"></i>Category</h1>
</div>

<section class="my-5">
    <div class="container"> 
     
               
           
        <div class="row theme-product ">

          <div class="col-md-3 mb-5">
            <div class="card">
              <div class="card-body">
                <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/5.jpg') }}" class="card-img-top" alt="..."></a>
                  <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Camera </a></h6>
                  <h5 class="card-title text-center">₹ 84,999</h5>
              </div>
            </div>
            </div>
            <div class="col-md-3 mb-5">
                <div class="card">
                  <div class="card-body">
                    <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/4.jpg') }}" class="card-img-top" alt="..."></a>
                      <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Chair</a></h6>
                      <h5 class="card-title text-center">₹ 2,999</h5>
                  </div>
                </div>
            </div>
            <div class="col-md-3 mb-5">
                <div class="card">
                  <div class="card-body">
                    <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/5.jpg') }}" class="card-img-top" alt="..."></a>
                      <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Camera </a></h6>
                      <h5 class="card-title text-center">₹ 84,999</h5>
                  </div>
            </div>
            </div>        
            <div class="col-md-3 mb-5">
              <div class="card">
                <div class="card-body">
                  <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/7.jpg') }}" class="card-img-top" alt="..."></a>
                    <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Television</a></h6>
                    <h5 class="card-title text-center">₹ 92,999</h5>
                </div>
              </div>
            </div>
            
            <div class="col-md-3 mb-5">
                <div class="card">
                  <div class="card-body">
                    <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/5.jpg') }}" class="card-img-top" alt="..."></a>
                      <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Camera </a></h6>
                      <h5 class="card-title text-center">₹ 84,999</h5>
                  </div>
                </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="card">
                      <div class="card-body">
                        <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/4.jpg') }}" class="card-img-top" alt="..."></a>
                          <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Chair</a></h6>
                          <h5 class="card-title text-center">₹ 2,999</h5>
                      </div>
                    </div>
                </div>
                <div class="col-md-3 mb-5">
                    <div class="card">
                      <div class="card-body">
                        <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/5.jpg') }}" class="card-img-top" alt="..."></a>
                          <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Camera </a></h6>
                          <h5 class="card-title text-center">₹ 84,999</h5>
                      </div>
                </div>
                </div>        
                <div class="col-md-3 mb-5">
                  <div class="card">
                    <div class="card-body">
                      <a href="#"class="text-decoration-none"><img src="{{ asset('asset/images/products/7.jpg') }}" class="card-img-top" alt="..."></a>
                        <h6 class="card-title text-center"> <a href="#"class="text-decoration-none">Television</a></h6>
                        <h5 class="card-title text-center">₹ 92,999</h5>
                    </div>
                  </div>
                </div>
           
        </div>
  </section>
@endsection