@extends('layout')
@section('content')
{{-- 
<section id="form" class="check-login"><!--form-->
    <div class="container-sign">
        <div class="primary-bg">
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
                <form action="{{URL::to('/login-customer')}}" method="POST">
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
                    <div class="form-group">
                        <button type="submit" class="form-submit">Đăng nhập</button>
                    </div>
                    <a href="#" class="forgot">Forgot Password?</a>
                    <div class="form-group">
                    <?php
                        $message = session()->get('message');
                        if($message){
                            echo '<span style="color:crimson"><i class="fa fa-check"></i>'.$message.'</span>';
                        }
                    ?>
                    </div>
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
                        <button type="submit" class="form-submit">Đăng ký</button>
                    </div>
                    <div class="form-group">
                        <?php
                            $message = session()->get('message');
                            if($message){
                                echo '<span style="color:crimson"><i class="fa fa-check"></i>'.$message.'</span>';
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><!--/form--> --}}

@endsection