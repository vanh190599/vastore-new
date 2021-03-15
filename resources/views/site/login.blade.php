@extends('frontend.layout_4')
@section('content')
{{--  Nếu như chưa đăng nhập thì hiện, còn khi đăng nhập rồi thì không hiện Form đăng nhập nữa    --}}
    @if( session('customer_email') == null)
            <?php echo session('customer_email') ?>
            <div class="text-center" style="font-size: 20px; color: red">
                @if(session('error-login')) {{session('error-login')}} @endif
                @if(session('message-register')) {{ session('message-register') }} @endif
            </div>

			<div class="row">
				<div class="col-sm-4 col-sm-offset-1 ">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{ url('login') }}" method="POST">
                            {{ csrf_field() }}
							<input type="email" name="customer_email" value="{{ isset($email)?$email:'' }}" placeholder="Email" required style="color:black;" />
							<input type="password" name="customer_password"  placeholder="mật khẩu" required style="color:black;" />
							<span>
								<input type="checkbox" class="checkbox">
								 Remember
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
                        <div class="clearfix"></div>
					</div><!--/login form-->
                    <br>
                    <p style="padding-bottom: 12px"></p>
{{--                    <a href="{{ url('login-facebook') }}" >--}}
{{--                        <div style="padding: 2px; background: #3b5998">--}}
{{--                            <img src="eshoper/images/facebook.png" style="width: 40px; height: 40px; margin-bottom: 5px" >--}}
{{--                            <span style="color:white; margin-left: 20px; font-size: 17px; padding-top: 12px">Login with Facebook</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    <br>--}}
{{--                    <a href="{{ url('login-google') }}" >--}}
{{--                        <div style="padding: 2px; background: #fc5345">--}}
{{--                            <img src="eshoper/images/google.png" style="width: 40px; height: 40px; margin-bottom: 2px; margin-top: 3px; margin-left: 7px" >--}}
{{--                            <span style="color:white; margin-left: 20px; font-size: 17px; padding-top: 15px">Login with Google</span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
				</div>

				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí</h2>
						<form action="{{ url('register-customer') }}" method="POST">
                            {{ csrf_field() }}
							<input type="text" name="customer_name" @if(session('name')) value="{{ session('name') }}" @endif placeholder="Họ tên" style="color:black;" required>
                            <input type="text" name="customer_phone" @if(session('phone')) value="{{ session('phone') }}" @endif placeholder="điện thoại" style="color:black;" required>
                            <div style="color: red; padding-bottom: 5px">@if(session('message')) {{session('message')}} @endif</div>
							<input type="email" name="customer_email" @if(session('email')) value="{{ session('email') }}" @endif placeholder="Email" style="color:black;" required/>
                            <div style="padding-bottom: 5px" class="text-info">
                                * Mật khẩu không chứa ký tự đặc biệt, độ dài 3-30 ký tự.
                            </div>
                            <input type="password" id="pass1" placeholder="mật khẩu" style="color:black;" required/>
                            <input type="password" id="pass2" name="customer_password" placeholder="nhập lại mật khẩu" style="color:black;" required/>
                            <div style="padding-bottom: 8px; color:red;" id="in"></div>
                            <button type="submit" onclick="return check()" class="btn btn-default">Đăng kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>

            <hr>

            <script !src="">
                function check() {
                    var pass1 = document.getElementById('pass1').value;
                    var pass2 = document.getElementById('pass2').value;
                    var regex = '[a-zA-Z0-9]$';
                    //khi edit nếu bằng rỗng thì cho submit (khong thay doi mat khau)

                    if(!pass1.match(regex) ){
                        document.getElementById('in').innerHTML = "Nhập mật khẩu không chứa kí tự đặc biệt !";
                        return false;
                    }
                    else if(pass1.length < 3 || pass1.length > 30){
                        // 3 den 30 ki tu
                        document.getElementById('in').innerHTML = "Nhập mật khẩu từ phải từ 3-30 kí tự !";
                        return false;
                    }
                    //neu sai thi dung lai, neu dung thi return true tiep tuc submit
                    else if(pass1 != pass2){
                        document.getElementById('in').innerHTML = "Mật khẩu không khớp";
                        return false;
                    }
                }
            </script>
    @endif
    @endsection
