@extends('layout_2')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Thanh toán giỏ hàng </li>
            </ol>
        </div><!--/breadcrums-->

        <div class="register-req">
            <p>Đăng nhập để thanh toán và xem lại lịch sử mua hàng</p>
        </div><!--/register-req-->

        <div class="shopper-informations text-center">
            <div class="row">
                <div class="">
                    <?php $customer_id = session()->get('customer_id'); ?>
                    <div class="bill-to" style="background: #e3e0d3; padding:4px">
                        <h4 style="color:#000; font-size:24px">Thêm thông tin người nhận để đặt hàng</h4>
                        <div class="form-one" style="width:50%">
                            <form action="{{URL::to('/save-checkout-customer/'.$customer_id)}}" method="POST" style="position: relative; left:50%;top:30px">
                                {{ csrf_field() }}
                                <input type="text" name="shipping_name" placeholder="Tên của bạn*" required>
                                <input type="email" name="shipping_email" placeholder="Email*" required>
                                <input type="text" name="shipping_phone" placeholder="Số điện thoại*" required>
                                <input type="text" name="shipping_address" placeholder="Địa chỉ 1 *" required>
                                <div class="form-group">
                                    <label for="" class="form-label">Lời nhắn:</label>
                                    <input type="text" class="form-control" name="shipping_message" placeholder="Lời nhắn cho người bán">
                                </div>		
                                <input type="submit" value="ĐĂT HÀNG" class="btn col-sm-4" style="color: #fff; background: #fe980f; font-weight:500">			
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

@endsection