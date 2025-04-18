@extends('layouts.app')
@section('content')


<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Wishlist</h2>
        <div class="shopping-cart">
            @if(Cart::instance("wishlist")->content()->count()>0)
            <div class="cart-table__wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::instance('wishlist')->content() as $wishlistItem)
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="{{asset('uploads/products/thumbnails')}}/{{$wishlistItem->model->image}}" width="120" height="120" alt="" />
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>{{$wishlistItem->name}}</h4>
                                    {{-- <ul class="shopping-cart__product-item__options">
                                        <li>Color: Yellow</li>
                                        <li>Size: L</li>
                                    </ul> --}}
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">${{$wishlistItem->price}}</span>
                            </td>
                            <td>
                                <div class="del-action">
                                    {{--  <button type="submit" class="remove-cart btn btn-sm btn-warning">Move to Cart</button>  --}}

                                    <form method="POST"
                                    action="{{ route('wishlist.remove', ['rowId' => $wishlistItem->rowId]) }}"
                                    id="remove-item-{{ $wishlistItem->rowId }}">
                                  @csrf
                                  @method('DELETE')

                                  <a href="javascript:void(0)"
                                     class="remove-cart"
                                     onclick="document.getElementById('remove-item-{{ $wishlistItem->rowId }}').submit();">
                                     <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.259435 8.85506C0.0889381 8.94404 0.0889381 9.14495 0.259435 9.23393C0.348413 9.28342 0.437391 9.29425 0.537535 9.29425C0.637678 9.29425 0.726656 9.28342 0.815633 9.23393L5 5.03754L9.18437 9.23393C9.362 9.41156 9.66159 9.41156 9.83921 9.23393C10.0168 9.0563 10.0168 8.75671 9.83921 8.57909L5.64282 4.39471L9.83921 0.200322C10.0168 0.0226968 10.0168 -0.276892 9.83921 -0.454518C9.66159 -0.632143 9.362 -0.632143 9.18437 -0.454518L5 3.74087L0.815633 -0.454518C0.637678 -0.632143 0.348413 -0.632143 0.170459 -0.454518C-0.0074951 -0.276892 -0.0074951 0.0226968 0.170459 0.200322L4.36685 4.39471L0.170459 8.57909C0.0922592 8.65729 0.0427701 8.75671 0.0427701 8.85506C0.0427701 8.95341 0.0922592 9.05283 0.170459 9.13103L0.259435 8.85506Z"/>
                                      </svg>

                                  </a>
                              </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="cart-table-footer">

                        <form method="POST" action="{{ route('wishlist.empty') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light">CLEAR WISHLIST</button>
                        </form>
                </div>
            </div>
            @else
                <div class="row">
                    <div class="col-md-12">
                        <p>No item found in your wishlist</p>
                        <a href="{{route('shop.index')}}" class="btn btn-info">Wishlist Now</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</main>
@endsection
