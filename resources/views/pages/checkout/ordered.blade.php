@extends('layout')
@section('content')

<div class="breadcrumbs">
    <ol class="breadcrumb">
      <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
      <li class="active">Đơn Hàng</li>
    </ol>
</div>
@if(session()->get('check_ordered'))
<section id="ordered">
<div class="ordered-content">
    <h2 class="text-center">ĐƠN HÀNG CỦA BẠN TRỐNG</h2>
</div>
</section>
@else
<section id="ordered">
    <div class="ordered-content">
        <h2>Cảm ơn bạn đã đặt hàng tại shop chúng tôi</h2>
        <h3>Bạn có thể xem lại các đơn hàng đã đặt 
            <span class="show-ordered" id="show-ordered"> tại đây<i class="fa-regular fa-hand-point-down" style="margin-left: 4px"></i></span>
            <span class="hide-ordered" id="hide-ordered">thu gọn<i class="fa-regular fa-hand-point-up" style="margin-left: 4px"></i></span>
        </h3>
    </div>
    @foreach ($show_ordered as $key => $ordered)
    
    <div class="box-ordered">
        <div class="ordered-item">
            <div class="ordered-title">
                <p>Trạng thái:
                    <?php
                    if($ordered->order_status == 0){
                        echo '<span style="color: rgb(72, 151, 241)">Chờ xác nhận</span>';
                    }
                    elseif($ordered->order_status == 1){
                        echo '<span style="color: rgb(72, 230, 241)"><i class="fa-regular fa-hand-back-fist"></i> Đang lấy hàng</span>';
                    }
                    elseif($ordered->order_status == 2){
                        echo '<span style="color: rgb(72, 241, 233)"><i class="fa-solid fa-truck"></i> Đang giao hàng</span>';
                    }
                    elseif($ordered->order_status == 3){
                        echo '<span style="color: rgb(55, 235, 100)"><i class="fa-solid fa-truck"></i> Đã giao thành công</span>';
                    }
                    elseif($ordered->order_status == 4){
                        echo '<span style="color: rgb(231, 77, 38)"><i class="fa-solid fa-bug"></i> Hết hàng</span>';
                    }       
                    ?>
                </p>
                <span style="color:rgb(255, 136, 0); text-transform:capitalize">Đã đánh giá<i class="fa-solid fa-star-half-stroke" style="margin-left: 4px"></i></span>
            </div>
                @foreach ($show_ordered_details as $key => $ordered_details)
                    @if ($ordered->order_id == $ordered_details->order_id)

                    <div class="order-details">
                        <div class="order-details-info">
                            <span><img src="{{URL::to('public/upload/product/'.$ordered_details->product_image)}}" alt=""></span>
                            <ul>
                                <li>{{$ordered_details->product_name}}</li>
                                <li>{!!$ordered_details->product_desc!!}</li>
                                <li style="text-transform: none">Số lượng: {{$ordered_details->product_order_quantity}}</li>
                            </ul>
                        </div>
                        <span class="order-details-price">{{number_format($ordered_details->product_price,'0',',','.')}} VNĐ</span>
                    </div>

                    @endif
                @endforeach
                    <div class="ordered-total">
                        <span style="line-height:32px">Tổng tiền(đã giảm):</span>
                        <span class="ordered-total-price">{{number_format($ordered->order_total,'0',',','.')}} VNĐ</span>
                    </div>
                    <div class="ordered-repurchase">
                        <button class="btn">Mua lại</button>
                    </div>
                </div>
            </div>

    @endforeach
        
</section> 
@endif

@endsection