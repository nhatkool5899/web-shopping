@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
    <!-- page start-->
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    QUẢN LÝ VẬN CHUYỂN
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form action="{{URL::to('/save-brand-product')}}" method="POST" class="form-horizontal" role="form">
                            {{ csrf_field() }}
                            
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label">Chọn thành phố</label>
                                <div class="col-lg-6">
                                    <select name="city" id="city" class="form-control choose city">
                                        <option value="">----Chọn tỉnh thành phố----</option>
                                        @foreach ($thanhpho as $item => $tp)                                     
                                        <option value="{{$tp->matp}}">{{$tp->name_tp}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label">Chọn quận huyện</label>
                                <div class="col-lg-6">
                                    <select name="province" id="province" class="form-control choose province">
                                        <option value="">----Chọn quận huyện----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label">Chọn xã phường</label>
                                <div class="col-lg-6">
                                    <select name="wards" id="wards" class="form-control wards">
                                        <option value="">----Chọn xã phường----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label">Phí vận chuyển</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control fee_ship" name="fee_ship" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-10">
                                    <button type="button" name="add_delivery" class="btn btn-success add-delivery">Thêm phí vận chuyển</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="load-delivery">
                        
                    </div>
                </div>
            </section>

        </div>
    </div>


    <!-- page end-->
</div>

@endsection