@extends('layout_2')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{session()->get('message')}}
				</div>
				@elseif(session()->has('error'))
					<div class="alert alert-danger">
						{{session()->get('error')}}
					</div>
			@endif
			<div class="table-responsive cart_info" style="background: #fff">
				
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image" style="width: 10%">Hình ảnh</td>
							<td class="description" style="width: 15%">Sản phẩm</td>
							<td class="price" style="width: 15%">Đơn giá</td>
							<td class="quantity" style="width: 5%">Số lượng</td>
							<td class="total" style="width: 20%">Thành tiền</td>
							<td style="width: 5%"></td>
						</tr>
					</thead>
					
					<tbody>
						<form action="{{URL::to('/update-cart')}}" method="post"> {{--Form-1--}}
							{{ csrf_field() }}

							@if(session()->get('cart') == true) {{--if-1--}}
							@php
								$total = 0;	
								$total_coupon = 0;	
							@endphp
							@foreach (session()->get('cart') as $item => $cart)
								@php
								$sub_total = $cart['product_price'] * $cart['product_qty'];	
								$total += $sub_total; 
								// session()->put('total', $total);
								@endphp

							<tr>
								<td class="cart_product">
									<a href=""><img width="90" src="{{URL::to('public/upload/product/'.$cart['product_image'])}}" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$cart['product_name']}}</a></h4>
									<p>Web ID: {{$cart['product_id']}}</p>
								</td>
								<td class="cart_price">
									<p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p>
								</td>
								<td class="cart_quantity">
									<div class="cart_quantity_button">
										
											{{-- <a class="cart_quantity_up" href=""> + </a>
											<input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
											<a class="cart_quantity_down" href=""> - </a> --}}

											<input style="width: 50px; height: 34px; margin-right: 6px" size="2" type="number"
											class="cart_quantity_input" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
											
									</div>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">{{number_format($sub_total,0,',','.')}} VNĐ</p>
								</td>
								<td class="cart_delete">
									<a class="cart_quantity_delete" href="{{URL::to('/delete-product-cart/'.$cart['session_id'])}}"><i class="fa-solid fa-delete-left"></i></a>
								</td>
							</tr>
							@endforeach
							<?php session()->put('total', $total); ?>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="" colspan="2" style="text-align: center">
										<input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="btn btn-default">
										<a href="{{URL::to('/del-all')}}" class="btn btn-default">Xóa tất cả</a>
									</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>
										<div class="row">
											<div class="total_area">
												<ul>
													<li>Tổng tiền<span>{{number_format($total,0,',','.')}} VNĐ</span></li>
													<li>Phí phát sinh <span>0</span></li>
													@if(session()->get('coupon'))
														@foreach (session()->get('coupon') as $key => $value)
															@if($value['coupon_condition'] == 1)
																<li>Mã ưu đãi giảm<span>{{$value['coupon_number']}} %</span></li>
																@php
																	$total_coupon = ($total*$value['coupon_number']/100);
																	echo '<li>Tiền giảm<span>'.number_format($total_coupon,0,',','.').'VNĐ</span></li>';
																@endphp
															@elseif($value['coupon_condition'] == 2)
															<li>Mã ưu đãi giảm<span>{{number_format($value['coupon_number'])}}đ</span></li>
																@php
																	$total_coupon = $value['coupon_number'];
																	echo '<li>Tiền giảm<span>'.number_format($total_coupon,0,',','.').'VNĐ</span></li>';
																@endphp
															@endif
														@endforeach
													@endif
													<li style="background: #ccc; color:black; font-weight:600">Tổng thanh toán<span>{{number_format($total - $total_coupon,0,',','.')}} VNĐ</span></li>
												</ul>
											</div>
										</div>
									</td>
								</tr>
							@else
								<tr>
									<td></td>
									<td></td>
									<td colspan="2"><img src="{{asset('public/front-end/images/cart/cart-empty.png')}}" alt=""></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td colspan="2"><a href="{{URL::to('/trang-chu')}}" class="btn btn-default check_out" style="margin-left: 60px">SHOPPING NOW</a></td>
								</tr>
							@endif
						</form>
					</tbody>
				</table>
				<div class="box-total">
					@if(session()->get('cart'))
					<?php
					if(session()->get('customer_id')){
						$i=0;
						foreach ($check_shipping as $key => $check) {
							// echo $check->shipping_id;
							$i++;
							if($check->customer_id == session()->get('customer_id')){
								session()->put('shipping_id', $check->shipping_id);
								?>
								<a class="btn btn-default check_out buy-product-to-cart pull-right" class="" href="{{URL::to('/payment')}}">MUA HÀNG</a>
								<?php
							}
						}
						if($i==0){
							?>
							<a class="btn btn-default check_out buy-product-to-cart pull-right" class="" href="{{URL::to('/checkout')}}">MUA HÀNG</a>
							<?php	
						}
					?>
						<?php
					}else{
						?>
						<a class="btn btn-default check_out buy-product-to-cart pull-right" class="" href="{{URL::to('/login-checkout')}}">MUA HÀNG</a>
						<?php
					}
					?>
					@endif
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection