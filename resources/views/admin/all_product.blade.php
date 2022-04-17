@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách các thương hiệu
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
                <th style="width:20px;">
                    <label class="i-checks m-b-none">
                    <input type="checkbox"><i></i>
                    </label>
                </th>
                {{-- <th>ID</th> --}}
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Hình ảnh</th>
                <th>Ẩn/Hiện</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($all_product as $key => $product)

                <tr>
                    <td><label class="i-checks m-b-none text-"><input type="checkbox" name="post[]"><i></i></label></td>
                    {{-- <td>{{ $product->product_id }}</td> --}}
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category_name }}</td>
                    <td>{{ $product->brand_name }}</td>
                    <td>{{ $product->product_quantity }}</td>
                    <td>{{ $product->product_price }}</td>
                    <td><img src="public/upload/product/{{ $product->product_img }}" height="60" width="80"></td>
                    <td><span class="text-ellipsis">
                        <?php
                        if($product->product_status == 0){
                        ?>
                            <a style="font-weight: 600" href="{{URL::to("/unactive-product/".$product->product_id)}}">Ẩn</a>
                        <?php
                        }else {
                        ?>
                            <a style="font-weight: 600" href="{{URL::to("/active-product/".$product->product_id)}}">Hiện</a>
                        <?php
                        }
                        ?>    
                    </span></td>
                    <td>
                        <a href="{{URL::to('/edit-product/'.$product->product_id)}}" class="active link-icon-category" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a> |
                        <a href="{{URL::to('/delete-product/'.$product->product_id)}}" onclick="return confirm('Bạn có chắc là xóa sản phẩm này?')" class="active link-icon-category" ui-toggle-class=""><i class="fa fa-times text-danger"></i></a>
                        
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