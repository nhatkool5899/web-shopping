<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	{{-- Seo --}}
	<meta name="robots" content="index, follow" /><meta>
	<meta name="keywords" content="index, follow" /><meta>
	<link rel="canonical" href="http://localhost/tieu-luan/">
    <meta name="description" content="">
    <meta name="author" content="">
	{{-- Seo --}}
    <title>Home | E-Shopper</title>
    <link href="{{asset('public/front-end/css/bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/front-end/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/front-end/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/front-end/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/front-end/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/front-end/css/main23.css')}}" rel="stylesheet">
	<link href="{{asset('public/front-end/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/front-end/css/style_sign6.css')}}" rel="stylesheet">
	<link href="{{asset('public/front-end/css/sweetalert.css')}}" rel="stylesheet">      
</head><!--/head-->

<body>

	<div class="app-shopping">
		<header id="header"><!--header-->
			<div class="header-background">	
				<div class="header_top"><!--header_top-->
					<div class="container">
						<div class="row">
							<div class="col-sm-4"  style="width:25%; padding: 0">
								<div class="contactinfo">
									<ul class="nav nav-pills">
										<li><a href="tel:0907977341"><i class="fa fa-phone"></i>0907 977 341</a></li>
										<li><a href="#"><i class="fa fa-envelope"></i>minhnhat14712@gmail.com</a></li>
									</ul>
								</div>
							</div>
							<div class="col-sm-7">
								<img style="width:100%; height:44px" src="{{asset('public/upload/banner/banner-min2.PNG')}}" alt="">
							</div>
							<div class="col-sm-1" style="height:44px; width:15%; padding: 0">
								<div class="social-icons pull-right">
									<ul class="nav navbar-nav">
										<li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
										<li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
										<li><a href="#"><i class="fa-brands fa-google-plus"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div><!--/header_top-->
			
				<div class="header-middle"><!--header-middle-->
					<div class="container">
						<div class="row">
							<div class="col-sm-2 header-middle-child">
								<div class="logo pull-left">
									<a href="{{URL::to('/trang-chu')}}"><img src="{{asset('public/front-end/images/home/logo.png')}}" alt="" /></a>
								</div>
							</div>
							<div class="col-sm-5 header-middle-child" style="display: flex; padding: 0">
								<form action="{{URL::to('/tim-kiem')}}" method="post">
									{{ csrf_field() }}
									<div class="pull-left">
										<span class="search_box">
											<input type="text" name="keyword_search" placeholder="Tìm kiếm...."/>
											<button type="button"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>
							</div>
							<div class="col-sm-5 header-middle-child">
								<div class="shop-menu pull-right">
									<ul class="nav navbar-nav">
										<?php
										if(session()->get('customer_id')){
											$customer_name = session()->get('customer_name');
											?>
											<li><a href="{{URL::to('/ordered/'.session()->get('customer_id'))}}"><i class="fa-brands fa-shopify" style="font-size: 16px"></i>Đơn hàng</a></li>
											<?php
										}else{
											?>
											<li id="check-account"><a href="#"><i class="fa-brands fa-shopify" style="font-size: 16px"></i>Đơn hàng</a></li>
											<?php
										}
										?>
										{{-- <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li> --}}
										<?php
										if(session()->get('customer_id')){
											?>
											<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
											<?php
										}else{
											?>
											<li id="check-cart"><a href="#"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a></li>
											<?php
										}
										?>
										<?php
										if(session()->get('customer_id')){
											?>
											<li><a href="{{URL::to('/logout-customer')}}"><i class="fa-solid fa-right-to-bracket"></i>Đăng xuất</a></li>
											<input type="hidden" value="1" class="login-success">
											<?php
										}else{
											?>
											<li><a href="#" class="link-login-customer"><i class="fa fa-lock"></i>Đăng nhập/Đăng kí</a></li>
											<input type="hidden" value="0" class="login-success">
											<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div><!--/header-middle-->
				<div class="modal-sign">
					<div class="modal-inner">
						<section class="check-login"><!--form-->
							<div class="container-sign">
								<div class="primary-bg">
									<div class="login-close">
										<button id="btn-close-login">X</button>
									</div>
									{{-- <div class="title-note">Truy cập bằng máy tính để có trải nghiệm tốt hơn:></div> --}}
									<div class="box signin">
										<h2>Bạn đã có tài khoản?</h2>
										<button class="signinBtn">Đăng Nhập Ngay</button>
									</div>
						
									<div class="box signup">
										<h2>Bạn chưa có tài khoản?</h2>
										<button class="signupBtn">Đăng Ký Ngay</button>
									</div>
								</div>
								<div class="formBx">
									<div class="form signinForm">
										<form>
											{{ csrf_field() }}
											<h4>Đăng nhập</h4>
											<div class="form-group">
												<input type="text" id="user-email" name="customer_email"  placeholder="Email..." />
												<span class="form-message"></span>
											</div>
											<div class="form-group">
												<input type="password" id="user-password" name="customer_password" placeholder="Mật khẩu..." />
												<span class="form-message"></span>
											</div>
											<div class="form-group box-message">
												<i class="fa-solid fa-exclamation"></i>
												<span>Sai tài khoản hoặc mật khẩu vui lòng kiểm tra lại</span>
											</div>
											<div class="form-group">
												<button type="button" class="form-submit btn-signin">Đăng nhập</button>
											</div>
											<a href="#" class="forgot">Forgot Password?</a>
										</form>
									</div>
						
									<div class="form signupForm">
										<form action="{{URL::to('/add-customer')}}" method="POST">
											{{ csrf_field() }}
											<h4>Đăng ký tài khoản</h4>
											<div class="form-group">
												<input type="text" id="new-user-name" name="customer_name"  placeholder="Tên của bạn" />
												<span class="form-message"></span>
											</div>
											<div class="form-group">
												<input type="email" id="new-user-email" name="customer_email" placeholder="Email"/>
												<span class="form-message"></span>
											</div>
											<div class="form-group">
												<input type="password" id="new-user-password" name="customer_password" placeholder="Mật khẩu"/>
												<span class="form-message"></span>
											</div>
											<div class="form-group">
												<input type="password" id="confirm-user-password" name="confirm_password" placeholder="Nhập lại mật khẩu"/>
												<span class="form-message"></span>
											</div>
											<div class="form-group">
												<button type="submit" class="form-submit btn-signup">Đăng ký</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</section><!--/form-->
					</div>
				</div>
		
				<div class="header-bottom"><!--header-bottom-->
					<div class="container">
						<div class="row">
							<ul class="col-sm-8 main-menu">
								<li>
									<a href="{{URL::to('/danh-muc-san-pham/1')}}">
										<i class="fa-solid fa-mobile"></i>
										<span>Điện thoại</span>
									</a>
								</li>
								<li>
									<a href="{{URL::to('/danh-muc-san-pham/2')}}">
										<i class="fa fa-laptop"></i>
										<span>Laptop</span>
									</a>
								</li>
								<li class="phukien">
									<a href="{{URL::to('/danh-muc-san-pham/3')}}">
										<i class="fa-solid fa-headphones"></i>
										<span>Phụ kiện</span>
									</a>
								</li>
								<li>
									<a href="{{URL::to('/danh-muc-san-pham/4')}}">
										<i class="fa-regular fa-clock"></i>
										<span>Đồng hồ thông minh</span>
									</a>
								</li>
								<li>
									<a href="">
										<i class="fa-regular fa-gem"></i>
										<span>Trang sức</span>
									</a>
								</li>
							</ul>
							<div class="col-sm-4">
								<div class="header-notice">
									<div>
										<span class="header-notice-icon">
											<i class="far fa-bell"></i>
											<span>Thông báo</span>
											<ul class="notice-box">
												<li><a href="" class="notice-item">
													<img src="{{asset('public/front-end/images/home/notice-sale.jpg')}}" alt="">
													<div class="notice-content">
														<div>Săn sale lớn nhân ngày 30/4</div>
														<div class="notice-date">20:10:2022</div>
													</div>
												</a></li>
												<li><a href="" class="notice-item">
													<img src="{{asset('public/front-end/images/home/notice-sale1.jpg')}}" alt="">
													<div class="notice-content">
														<div>Săn sale lớn trong năm nhân dịp quốc khánh 2/9</div>
														<div class="notice-date">20:10:2022</div>
													</div>
												</a></li>
												<li><a href="" class="notice-item">
													<img src="{{asset('public/front-end/images/home/notice-sale2.jpg')}}" alt="">
													<div class="notice-content">
														<div>Siêu sale điện thoại bùng nổ, rinh ngay kẻo lỡ</div>
														<div class="notice-date">20:10:2022</div>
													</div>
												</a></li>
											</ul>
										</span>
									</div>
								</div>
							</div>
							
						</div>
						<div class="dayNight activeNight pull-right">
							<span class="day-icon day-icon-day"><i class="fa-solid fa-sun"></i></span>
							<span class="day-icon day-icon-night active-dayNight"><i class="fa-solid fa-moon"></i></span>
						</div>
					</div>
				</div><!--/header-bottom-->
			</div>
		</header><!--/header-->
		
		@yield('content')
		
		<footer id="footer"><!--Footer-->
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="companyinfo">
								<h2><span>e</span>-shopper</h2>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="#">
										<div class="iframe-img">
											<img src="images/home/iframe1.png" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Circle of Hands</p>
									<h2>24 DEC 2014</h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="#">
										<div class="iframe-img">
											<img src="images/home/iframe2.png" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Circle of Hands</p>
									<h2>24 DEC 2014</h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="#">
										<div class="iframe-img">
											<img src="images/home/iframe3.png" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Circle of Hands</p>
									<h2>24 DEC 2014</h2>
								</div>
							</div>
							
							<div class="col-sm-3">
								<div class="video-gallery text-center">
									<a href="#">
										<div class="iframe-img">
											<img src="images/home/iframe4.png" alt="" />
										</div>
										<div class="overlay-icon">
											<i class="fa fa-play-circle-o"></i>
										</div>
									</a>
									<p>Circle of Hands</p>
									<h2>24 DEC 2014</h2>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="address">
								<img src="images/home/map.png" alt="" />
								<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Service</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Online Help</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Order Status</a></li>
									<li><a href="#">Change Location</a></li>
									<li><a href="#">FAQ’s</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Quock Shop</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">T-Shirt</a></li>
									<li><a href="#">Mens</a></li>
									<li><a href="#">Womens</a></li>
									<li><a href="#">Gift Cards</a></li>
									<li><a href="#">Shoes</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Policies</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Terms of Use</a></li>
									<li><a href="#">Privecy Policy</a></li>
									<li><a href="#">Refund Policy</a></li>
									<li><a href="#">Billing System</a></li>
									<li><a href="#">Ticket System</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>About Shopper</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Company Information</a></li>
									<li><a href="#">Careers</a></li>
									<li><a href="#">Store Location</a></li>
									<li><a href="#">Affillate Program</a></li>
									<li><a href="#">Copyright</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3 col-sm-offset-1">
							<div class="single-widget">
								<h2>About Shopper</h2>
								<form action="#" class="searchform">
									<input type="text" placeholder="Your email address" />
									<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
									<p>Get the most recent updates from <br />our site and be updated your self...</p>
								</form>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
						<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
					</div>
				</div>
			</div>
			
		</footer><!--/Footer-->
	</div>
	

  
    <script src="{{asset('public/front-end/js/jquery.js')}}"></script>
	<script src="{{asset('public/front-end/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/front-end/js/all.min.js')}}"></script>
	<script src="{{asset('public/front-end/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/front-end/js/price-range.js')}}"></script>
    <script src="{{asset('public/front-end/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/front-end/js/main.js')}}"></script>
    <script src="{{asset('public/front-end/js/sweetalert.js')}}"></script>
    <script src="{{asset('public/front-end/js/validator.js')}}"></script>
	{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

	<script>
        const signinBtn = document.querySelector('.signinBtn')
        const signupBtn = document.querySelector('.signupBtn')
        const formBx = document.querySelector('.formBx');
        const check_login = document.querySelector('.check-login')

        signupBtn.onclick = function() {
            formBx.classList.add('active')
            check_login.classList.add('active')
        }
        signinBtn.onclick = function() {
            formBx.classList.remove('active')
            check_login.classList.remove('active')
        }
    </script>

<script>
	$('.day-icon-night').click(function(){
		$('.day-icon-night').removeClass('active-dayNight');
		$('.day-icon-day').addClass('active-dayNight');
		$('.app-shopping').addClass('app-container');
		$('.category-products').addClass('category-products-dark');
	});
	$('.day-icon-day').click(function(){
		$('.day-icon-day').removeClass('active-dayNight');
		$('.day-icon-night').addClass('active-dayNight');
		$('.app-shopping').removeClass('app-container');
		$('.category-products').removeClass('category-products-dark');
	});

</script>

	<script>
		$('.link-login-customer').click(function(){
			$('.modal-sign').addClass('show-sign');
		});
		$('#btn-close-login').click(function(){
			$('.modal-sign').removeClass('show-sign');
		});
		$('.modal-sign').click(function(e){
			if(e.target == e.currentTarget){
				$(this).removeClass('show-sign');
			}
		});
	
	</script>

<script>
	$('#show-ordered').click(function(){
		$('.box-ordered').addClass('show-box-ordered');
		$('#show-ordered').css('display','none');
		$('#hide-ordered').css('display','inline-block');
	});
	$('#hide-ordered').click(function(){
		$('.box-ordered').removeClass('show-box-ordered');
		$('#show-ordered').css('display','inline-block');
		$('#hide-ordered').css('display','none');
	});

</script>

	<script type="text/javascript">
		$('.btn-signin').click(function(){
			var customer_email = $('#user-email').val();
			var customer_password = $('#user-password').val();
			var _token = $('input[name="_token"]').val();

			$.ajax({
                url: '{{url('/login-customer')}}',
                method: 'POST',
                data:{customer_email:customer_email, customer_password:customer_password, _token:_token},
                success:function(data){
                   if(data == 'success'){
					   	location.reload();
				   }
				   else{
						$('.box-message').addClass('show-error-message');
				   }
                }
            });
		})
	</script>

<script>
	// mục tiêu 
	Validator({
		form: '.signupForm',
		errorSelector: '.form-message',
		rules: [
			Validator.isRequired('#new-user-name'),
			Validator.isRequired('#new-user-email'),
			Validator.isEmail('#new-user-email'),
			Validator.isRequired('#new-user-password'),
			Validator.isMinLength('#new-user-password', 5),
			Validator.isRequired('#new-user-tel'),
			Validator.isRequired('#confirm-user-password'),
			Validator.isConfirmed('#confirm-user-password', () => {
				return document.querySelector('.signupForm #new-user-password').value
			}, 'Mật khẩu nhập lại không trùng khớp')
		]
		// onSubmit(data) {
		// 	// call API để tạo dữ liệu
		// 	console.log(data)
		// }
	})

	Validator({
		form: '.signinForm',
		errorSelector: '.form-message',
		rules: [
			Validator.isRequired('#user-email', "Bạn chưa nhập vào Email"),

			Validator.isRequired('#user-password', "Bạn chưa nhập vào mật khẩu"),
		]
		// onSubmit(data) {
		// 	// call API để tạo dữ liệu
		// 	console.log(data)
		// }
	})
</script>

	<script type="text/javascript">
		$(document).ready(function(){
//Test account
			$('#check-account').click(function(){
				swal("Bạn chưa đăng nhập!", "Vui lòng đăng nhập để xem hồ sơ!", "warning");
			})		
			$('#check-cart').click(function(){
				swal({
                                title: "Bạn chưa đăng nhập!",
                                text: "Vui lòng đăng nhập để sử dụng chức năng giỏ hàng",
                                showCancelButton: true,
                                cancelButtonText: "OK",
                                confirmButtonClass: "btn-warning",
                                confirmButtonText: "Đăng nhập ngay",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/login-checkout')}}";
                            });
			})	
//Thêm giỏ hàng
			$('.add-to-cart').click(function(){	
				var login = $('.login-success').val();
				if(login == 0){
					$('.modal-sign').addClass('show-sign');				
				}else{
					var id = $(this).data('id_product');
					var check_product_qty = $('.check_product_qty_' +  id).val();
					var cart_product_id = $('.cart_product_id_' +  id).val();
					var cart_product_name = $('.cart_product_name_' +  id).val();
					var cart_product_image= $('.cart_product_image_' +  id).val();
					var cart_product_desc= $('.cart_product_desc_' +  id).val();
					var cart_product_price = $('.cart_product_price_' +  id).val();
					var cart_product_qty = $('.cart_product_qty_' +  id).val();
					var _token = $('input[name="_token"]').val();
					// alert(cart_product_desc);
					if(check_product_qty < cart_product_qty){
						swal("Sản phẩm tạm hết hàng!");
					}else{
	
						$.ajax({
							url: '{{url('/add-cart-ajax')}}',
							method: 'POST',
							data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_desc:cart_product_desc,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
							success:function(){
								swal({
										title: "Đã thêm sản phẩm vào giỏ hàng",
										text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
										showCancelButton: true,
										cancelButtonText: "Xem tiếp",
										confirmButtonClass: "btn-success",
										confirmButtonText: "Đi đến giỏ hàng",
										closeOnConfirm: false
									},
									function() {
										window.location.href = "{{url('/gio-hang')}}";
									});
		
							}
						});
					}
				}

			});
//Phí vận chuyển
			$('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action == 'city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url: '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action, ma_id:ma_id, _token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
		});
	</script>
	<script>
		$('.calculate_delivery').click(function (){
			var matp = $('.city').val(); 
			var maqh = $('.province').val(); 
			var xaid = $('.wards').val(); 
            var _token = $('input[name="_token"]').val();
			if(matp=='' || maqh=='' || xaid==''){
				swal("Địa chỉ giao hàng rỗng!", "Vui lòng chọn địa chỉ để thực hiện thanh toán", "warning");
			}else{

				$.ajax({
					url: '{{url('calculate-fee')}}',
					method: 'POST',
					data:{matp:matp, maqh:maqh, xaid:xaid, _token:_token},
					success:function(data){
						location.reload();
					}
				});
			}
		});
	</script>
</body>
</html>