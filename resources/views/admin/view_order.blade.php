@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin người mua
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th>Tên người mua</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order_by_id->customer_name }}</td>
                        <td>{{ $order_by_id->customer_email }}</td>
                        <td>{{ $order_by_id->customer_phone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th>Tên người nhận hàng</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ghi chú</th>
                    <th>Hình thức thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order_by_id->shipping_name }}</td>
                        <td>{{ $order_by_id->shipping_address }}</td>
                        <td>{{ $order_by_id->shipping_phone }}</td>
                        <td>{{ $order_by_id->shipping_message }}</td>
                        <td><?php 
                            if($order_by_id->payment_method==1){
                                echo "Thanh toán qua thẻ ATM";
                            }elseif($order_by_id->payment_method==2) {
                                echo "Thanh toán khi nhận hàng";
                            }else{
                                echo "Thanh toán PayPal";
                            }
                        ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Chi tiết đơn hàng
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <?php
                    $message = Session::get('message');
                    if($message){
                        echo  $message;
                        session()->put('message', null);
                    }
                ?>
                <thead>
                    <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Số lượng trong kho</th>
                    <th>Đơn giá</th>
                    <th>Số tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_details_by_id as $key => $val)

                    <tr>
                        <td>{{ $val->product_name }}</td>
                        <td>
                            <form>
                                {{ csrf_field() }}
                                
                                @if($order_by_id->order_status==3 || $order_by_id->order_status==4)
                                
                                <input type="number" readonly class="order-qty-{{$val->product_id}}" min="1" style="width: 60px"  name="product_quantity" value="{{ $val->product_order_quantity }}">
    
                                @else
                                <input type="hidden" name="order_id" class="order_id" value="{{ $val->order_id }}">
                                <input type="hidden" name="order_product_id" class="order_product_id" value="{{ $val->product_id }}">
                                <input type="number" class="order-qty-{{$val->product_id}}" min="1" style="width: 60px"  name="product_quantity" value="{{ $val->product_order_quantity }}">
                                <input type="button" value="Cập nhật" data-product_id="{{ $val->product_id }}" class="btn btn-send update-qty-order" style="padding: 4px 6px; font-size: 12px">
                                @endif
                            </form>
                        </td>
                        <td>
                            @foreach ($product_in_order as $key => $wh)
                            <?php if ($wh->product_id == $val->product_id ){
                            echo $wh->product_quantity;
                            }
                            ?>
                         @endforeach
                        </td>
                        <td>{{ number_format($val->product_price) }} VNĐ</td>
                        <td>{{ number_format($val->product_price * $val->product_order_quantity) }} VNĐ</td>
                    </tr>

                    @endforeach
                   
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Mã giảm giá:</td>
                        <td>{{$val->order_coupon}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Phí vận chuyển:</td>
                        <td>{{number_format($val->order_feeship)}} VNĐ</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight:500; color:black">Tổng tiền (đã thêm các phí):</td>
                        <td style="color: black">{{number_format($val->order_total)}} VNĐ</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="font-weight:700;font-size:20px; color:rgb(17, 13, 230)">Xử lý đơn hàng:</td>
                    <form>
                        {{ csrf_field() }}
                        @if($order_by_id->order_status==0 || $order_by_id->order_status==1 || $order_by_id->order_status==2 )
                        <td>
                            @if($order_by_id->order_status==0)
                                <select name="result_order_details" class="select_order_details" style="font-size:16px; height:32px; color: black; background: rgb(208, 239, 245)">
                                    <option id="{{$order_by_id->order_id}}" selected value="0">Đơn hàng mới</option>    
                                    <option id="{{$order_by_id->order_id}}" value="1">Đang lấy hàng</option>    
                                    <option id="{{$order_by_id->order_id}}" value="2">Đang vận chuyển</option>    
                                    <option id="{{$order_by_id->order_id}}" value="3">Đã giao</option>    
                                    <option id="{{$order_by_id->order_id}}" value="4">Hết hàng</option>    
                                </select> 
                            @elseif($order_by_id->order_status==1)
                                <select name="result_order_details" class="select_order_details" style="font-size:16px; height:32px; color: black; background: rgb(208, 239, 245)">
                                    <option id="{{$order_by_id->order_id}}" value="0">Đơn hàng mới</option>    
                                    <option id="{{$order_by_id->order_id}}" selected value="1">Đang lấy hàng</option>    
                                    <option id="{{$order_by_id->order_id}}" value="2">Đang vận chuyển</option>    
                                    <option id="{{$order_by_id->order_id}}" value="3">Đã giao</option>    
                                    <option id="{{$order_by_id->order_id}}" value="4">Hết hàng</option>    
                                </select> 
                            @elseif($order_by_id->order_status==2)
                                <select name="result_order_details" class="select_order_details" style="font-size:16px; height:32px; color: black; background: rgb(208, 239, 245)">
                                    <option id="{{$order_by_id->order_id}}" value="0">Đơn hàng mới</option>    
                                    <option id="{{$order_by_id->order_id}}" value="1">Đang lấy hàng</option>    
                                    <option id="{{$order_by_id->order_id}}" selected value="2">Đang vận chuyển</option>    
                                    <option id="{{$order_by_id->order_id}}" value="3">Đã giao</option>    
                                    <option id="{{$order_by_id->order_id}}" value="4">Hết hàng</option>    
                                </select> 
                            @elseif($order_by_id->order_status==3)
                                <select name="result_order_details" class="select_order_details" style="font-size:16px; height:32px; color: black; background: rgb(208, 239, 245)">
                                    <option id="{{$order_by_id->order_id}}" value="0">Đơn hàng mới</option>    
                                    <option id="{{$order_by_id->order_id}}" value="1">Đang lấy hàng</option>    
                                    <option id="{{$order_by_id->order_id}}" value="2">Đang vận chuyển</option>    
                                    <option id="{{$order_by_id->order_id}}" selected value="3">Đã giao</option>    
                                    <option id="{{$order_by_id->order_id}}" value="4">Hết hàng</option>    
                                </select> 
                            @elseif($order_by_id->order_status==4)
                                <select name="result_order_details" class="select_order_details" style="font-size:16px; height:32px; color: black; background: rgb(208, 239, 245)">
                                    <option id="{{$order_by_id->order_id}}" value="0">Đơn hàng mới</option>    
                                    <option id="{{$order_by_id->order_id}}" value="1">Đang lấy hàng</option>    
                                    <option id="{{$order_by_id->order_id}}" value="2">Đang vận chuyển</option>    
                                    <option id="{{$order_by_id->order_id}}" value="3">Đã giao</option>    
                                    <option id="{{$order_by_id->order_id}}" selected value="4">Hết hàng</option>    
                                </select> 
                            @endif
                        </td>
                        @elseif($order_by_id->order_status==3)
                            <td><span  style="font-size:16px; border-bottom:2px solid #ccc; color: rgb(8, 231, 45);">Đã giao hàng</span></td>
                        @elseif($order_by_id->order_status==4)
                            <td><span  style="font-size:16px; border-bottom:2px solid #ccc; color: rgb(224, 77, 19);">Hết hàng</span></td>
                        @endif

                        @if($order_by_id->order_status==0 || $order_by_id->order_status==1 || $order_by_id->order_status==2)
                        <td><input type="button" class="btn btn-success result_order_details" value="XÁC NHẬN"></td> 
                        @endif
                    </form>

                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><a href="{{URL::to('/manage-order')}}" class="btn" style="background: #ccc"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> BACK</a></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection