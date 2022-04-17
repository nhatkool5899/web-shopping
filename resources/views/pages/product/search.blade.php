@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
    <?php
    $keyw = session()->get('keyword');
    if($keyw){
        echo '<h2 class="title text-center">Sản phẩm liên quan đến "'.$keyw.'"</h2>';
    }
    ?>
    @foreach ($search_product as $item =>$product)
    
    <div class="col-sm-3 product-main">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo">
                    <form>
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$product->product_quantity}}" class="check_product_qty_{{$product->product_id}}">

                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_img}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">


                        <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
                            <img src="{{URL::to('public/upload/product/'.$product->product_img)}}" alt="" />
                        </a>
                        <p>{{$product->product_name}}</p>
                        <div class="product-price-sold">
                            <span class="product-price">{{number_format($product->product_price,0,',','.')}}.đ</span>
                            <span class="product-sold">Đã bán 100</span>
                        </div>
                        <div class="product-rate-cart">
                            <div class="product-rate">
                                <img style="width:75%; margin-top:0" src="{{asset('public/front-end/images/product-details/rating.png')}}" alt=""/>
                                <span style="color: #ccc; margin-left:4px">10</span>
                            </div>
                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart"><i class="fa-solid fa-cart-plus"></i></button>
                        </div>

                        {{-- <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}" class="btn btn-default add-to-cart">
                            <i class="fa fa-shopping-cart"></i>Add to cart</a> --}}

                    </form>
                </div>

            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    {{-- <li><a href="#"><i class="fa-solid fa-heart active like-product"></i>Add to wishlist</a></li> --}}
                    <li><a href="#" ><i class="fa-regular fa-heart like-product"></i>Yêu thích</a></li>
                    <li><a href="#" class=""><i class="fa-solid fa-down-left-and-up-right-to-center" style="color: rgb(115, 115, 241)"></i>So sánh</a></li>
                </ul>
            </div>
        </div>
    </div>
    @endforeach
    
</div><!--product body-->

@endsection