@extends('admin_layout')
@section('admin_content')
<div class="form-w3layouts">
    <!-- page start-->
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <div class="">
                        <form action="{{URL::to('/save-product')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Tên sản phẩm</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="product_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Số lượng</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="product_quantity" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Mô tả sản phẩm</label>
                            <div class="col-lg-9">
                                <textarea style="resize: none" rows="3" class="form-contro" name="product_desc" id="ckeditor"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Nội dung sản phẩm</label>
                            <div class="col-lg-9">
                                <textarea style="resize: none" class="form-control" name="product_content" id="ckeditor1"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Giá</label>
                            <div class="col-lg-9">
                                <input type="text" class="form-control" name="product_price" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Hình ảnh(600x600)</label>
                            <div class="col-lg-6">
                                <input type="file" class="form-control" name="product_img" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Danh mục</label>
                            <div class="col-lg-4">
                                <select name="product_category" class="form-control">
                                    @foreach ($category_product as $item => $category)
                                    <option value="{{$category->category_id}}">{{$category->category_name}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Thương hiệu</label>
                            <div class="col-lg-4">
                                <select name="product_brand" class="form-control">
                                    @foreach ($brand_product as $item => $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 col-sm-3 control-label">Hiển thị</label>
                            <div class="col-lg-2">
                                <select name="product_status" class="form-control">
                                    <option value="1">Ẩn</option>
                                    <option value="0">Hiện</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-10">
                                <button type="submit" name="add_category_product" class="btn btn-success">Thêm sản phẩm</button>
                            </div>
                        </div>
                        <div class="col-lg-offset-3 text-success">
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span><i class="fa fa-check"></i>';
                            echo  $message;
                            echo  '</span>';
                            session()->put('message', null);
                        }
                        ?>

                        </div>
                    </form>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Modal form
                </header>
                <div class="panel-body">
                    <div class="position-center ">
                        <div class="text-center">
                            <a href="#myModal" data-toggle="modal" class="btn btn-success">
                                Form in Modal
                            </a>
                            <a href="#myModal-1" data-toggle="modal" class="btn btn-warning">
                                Form in Modal 2
                            </a>
                            <a href="#myModal-2" data-toggle="modal" class="btn btn-danger">
                                Form in Modal 3
                            </a>
                        </div>

                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title">Form Tittle</h4>
                                </div>
                                <div class="modal-body">

                                    <form role="form">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile">File input</label>
                                            <input type="file" id="exampleInputFile3">
                                            <p class="help-block">Example block-level help text here.</p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Check me out
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-1" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title">Form Tittle</h4>
                                </div>
                                <div class="modal-body">

                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Email</label>
                                            <div class="col-lg-10">
                                                <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Password</label>
                                            <div class="col-lg-10">
                                                <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> Remember me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button type="submit" class="btn btn-default">Sign in</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal-2" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                    <h4 class="modal-title">Form Tittle</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-inline" role="form">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                            <input type="email" class="form-control sm-input" id="exampleInputEmail5" placeholder="Enter email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputPassword2">Password</label>
                                            <input type="password" class="form-control sm-input" id="exampleInputPassword5" placeholder="Password">
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Remember me
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-default">Sign in</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </section>
        </div>
    </div>



    <!-- page end-->
</div>

@endsection