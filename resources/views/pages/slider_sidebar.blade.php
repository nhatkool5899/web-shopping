@section('slider')
<div class="row">
    <div class="col-sm-12">
        {{-- Main-banner --}}
        <div id="slider-carousel" class="carousel slide col-sm-9" data-ride="carousel">
            <ol class="carousel-indicators" style="bottom: 40px">
                <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#slider-carousel" data-slide-to="1"></li>
                <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner main-slider">
                <div class="item active">
                    <a href="">
                        <img src="https://cdn.tgdd.vn/2022/04/banner/A73-830-300-830x300.png" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{asset('public/front-end/images/home/slider-banner1.png')}}" alt="">
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="{{asset('public/front-end/images/home/slider-banner2.png')}}" alt="">
                    </a>
                </div>
                
                
            </div>
           
            <div class="control-carousel-hidden">
                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left" style="box-shadow: 4px 3px #ccc;"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" style="right: 15px" data-slide="next">
                    <i class="fa fa-angle-right" style="box-shadow: -4px 3px #ccc;"></i>
                </a>
            </div>

            <div class="min-banner">
                <img src="public/upload/banner/banner-min1.PNG" alt="">
            </div>
        </div>

        {{-- Slider-sale --}}
        <div id="slider-carousel2" class="carousel slide col-sm-3" data-ride="carousel">
            <ol class="carousel-indicators" style="bottom: 62px">
                <li data-target="#slider-carousel2" data-slide-to="0" class="active"></li>
                <li data-target="#slider-carousel2" data-slide-to="1"></li>
                <li data-target="#slider-carousel2" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner mini-slider">
                <div class="item active">
                    <a href="">
                        <img src="https://cdn.tgdd.vn/2022/03/banner/laptopdesk-222-340x340.jpg" alt="" />
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="https://cdn.tgdd.vn/2022/03/banner/laptopdesk1111111-340x340.jpg" alt="" />
                    </a>
                </div>
                <div class="item">
                    <a href="">
                        <img src="https://cdn.tgdd.vn/2022/03/banner/macbooksticky-340x340.jpg" alt="" />
                    </a>
                </div>
                
            </div>
            <ul class="code-coupon-fee">
                <li>Mã khuyến mãi</li>
                <li>Mã free ship</li>
                <li>Mã 0 đồng</li>
            </ul>
        </div>
        
    </div>

    </div>
</div>

@endsection