@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    @foreach ($brand_name as $item =>$brand_name_id)
    <h2 class="title text-center">Thương hiệu {{ $brand_name_id->brand_name }}</h2>
    @endforeach
    @foreach ($brand_by_id as $item =>$product)
    <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
    
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('public/upload/product/'.$product->product_img)}}" alt="" />
                            <h2>{{number_format($product->product_price)}}.đ</h2>
                            <p>{{$product->product_content}}</p>
                            <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                        {{-- <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{number_format($product->product_price)}}.đ</h2>
                                <p>{{$product->product_content}}</p>
                                <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div> --}}
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </a>
    
    @endforeach
</div><!--features_items-->

@endsection