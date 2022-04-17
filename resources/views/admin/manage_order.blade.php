@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách các đơn hàng
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>                
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
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
                    <th>STT</th>
                    <th>Tên người đặt</th>
                    <th>Mã đơn hàng</th>
                    <th>Tổng giá tiền</th>
                    <th>Tình trạng</th>
                    <th>Ngày đặt</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; ?>
                @foreach ($all_order as $key => $order)
                    <?php $i++; ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->order_code }}</td>
                    <td>{{number_format($order->order_total)}} VNĐ</td>
                    <td style="font-weight:500"><?php 
                        if($order->order_status==0){
                            echo '<span style="color: blue">Đơn hàng mới</span>';
                        }elseif($order->order_status==1) {
                            echo '<span style="color: rgb(255, 81, 0)">Đang lấy hàng';
                        }elseif($order->order_status==2) {
                            echo '<span style="color: rgb(255, 208, 0)">Đang giao hàng';
                        }elseif($order->order_status==3) {
                            echo '<span style="color: green">Đã giao hàng';
                        }else{
                            echo '<span style="color: rgb(236, 69, 18)">Hết hàng!';
                        }
                         ?></td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active link-icon-category" ui-toggle-class=""><i class="fa fa-eye"></i></a> |
                        <a href="{{URL::to('/delete-order/'.$order->order_id)}}" onclick="return confirm('Bạn có chắc là xóa đơn hàng này?')" class="active link-icon-category" ui-toggle-class=""><i class="fa fa-times text-danger"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
    </footer>
    </div>
  </div>

@endsection