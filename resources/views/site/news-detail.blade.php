@extends('frontend.layout_news')
@section('content')

<div class="col-sm-10">
	<h2 class="title text-center" style="margin-top: 2px; color: orangered">
    	Trang tin tức
    </h2>

	<!-- row	 -->
    <div class="rows">
    	<!-- one new-->
    	
        <div class="col-lg-8 col-md-8 col-sm-12" style="margin-bottom: 10px;">
			<div class="box">
				<div class="photo-news">
					<img src="upload/news/1.jpg" alt="">
				</div>
				<div class="tilte-news"><a href="#">Microsoft Flight Simulation tựa game cần đến bộ nhớ 2TB mô phỏng chi tiết như ngoài đời thực</a></div>
				<p>Theo video mới đăng tải trên YouTub đăng tải trên YouTube thì Microsoft Flight Simulator hứa hẹn sẽ...</p>
				<p style="padding-top: 20px; font-size: 12px">28-03-2020, 7:10 pm</p>
			</div>
        </div>
        <!-- one new-->
		
		<!-- news latest -->
        <div class="col-lg-4 col-md-4 col-sm-12 " style="padding: 0; margin: 0 ">
        	<div class="box-right">
        		<p class="text-center title-lastest">TIN MỚI NHẤT</p>
        		<ul>
        			<li style="display: flex;">
        				<a href="#">
        					<img src="upload/news/1.jpg" style="width: 90px; height: 80px; " alt="">
							<div class="content-right">
								<a href="#">Microsoft Flight Simulation tựa game cần đến bộ nhớ 2TB mô ...</a>
								<p style="padding-top: 20px; font-size: 10px">28-03-2020, 7:10 pm</p>
							</div>	
        				</a>
        			</li>
        			<div style="border: 1px dashed #dddddd"></div>
        			
        			<li style="display: flex;">
        				<a href="#">
        					<img src="upload/news/1.jpg" style="width: 90px; height: 80px; " alt="">
							<div class="content-right">
								<a href="#">Microsoft Flight Simulation tựa game cần đến bộ nhớ 2TB mô ...</a>
								<p style="padding-top: 20px; font-size: 10px">28-03-2020, 7:10 pm</p>
							</div>	
        				</a>
        			</li>
        			<div style="border: 1px dashed #dddddd"></div>

        			<li style="display: flex;">
        				<a href="#">
        					<img src="upload/news/1.jpg" style="width: 90px; height: 80px; " alt="">
							<div class="content-right">
								<a href="#">Microsoft Flight Simulation tựa game cần đến bộ nhớ 2TB mô ...</a>
								<p style="padding-top: 20px; font-size: 10px">28-03-2020, 7:10 pm</p>
							</div>	
        				</a>
        			</li>
        			<div style="border: 1px dashed #dddddd"></div>

        			<li style="display: flex;">
        				<a href="#">
        					<img src="upload/news/1.jpg" style="width: 90px; height: 80px; " alt="">
							<div class="content-right">
								<a href="#">Microsoft Flight Simulation tựa game cần đến bộ nhớ 2TB mô ...</a>
								<p style="padding-top: 20px; font-size: 10px">28-03-2020, 7:10 pm</p>
							</div>	
        				</a>
        			</li>
        			<div style="border: 1px dashed #dddddd"></div>
        		</ul>
        		<p class="text-right" style="padding: 0; margin: 0px"><a href="#">Xem thêm</a></p>
        	</div>
        </div>
        <!-- end news latest -->
        <div class="clearfix"></div>
    </div>
    <!-- end rows -->
	
	<hr>


</div>
    @endsection
