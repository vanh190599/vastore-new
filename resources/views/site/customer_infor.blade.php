@extends('frontend.layout_4')
@section('content')
        <div class="text-center" style="font-size: 20px; color: red">
            @if(session('error-login')) {{session('error-login')}} @endif
            @if(session('message')) {{session('message')}} @endif
        </div>
        <div class="text-center text-info" style="font-size: 20px">
            @if(session('edit-complete')) {{ session('edit-complete') }} @endif
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1 ">
                <div class="login-form"><!--login form-->
                    <h2>Thông tin cá nhân</h2>
                         <span class="glyphicon glyphicon-phone-alt"></span>  Họ tên<input type="text"  class="form-control" value="{{ isset($customer_name)?$customer_name:'' }}" style="color:black; margin: 6px 0px 6px 0px" readonly />
                         <span class="glyphicon glyphicon-envelope"></span>  Email<input type="text"  class="form-control" value="{{ isset($customer_email)?$customer_email:'' }}" style="color:black; margin: 6px 0px 6px 0px" readonly />
                         <span class="glyphicon glyphicon-phone"></span>  Điện thoại<input type="text"  class="form-control" value="{{ isset($customer_phone)?$customer_phone:'' }}" style="color:black; margin: 6px 0px 6px 0px" readonly />
                         <span class="glyphicon glyphicon-star"></span>  Code<input type="text"  class="form-control" value="{{ isset($customer_id)?$customer_id:'' }}" style="color:black; margin: 6px 0px 6px 0px" readonly />
                </div><!--/login form-->
            </div>

            @if(session('check_change_password') != "dont-show")
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2 style="padding-bottom: 23px">Thay đổi mật khẩu</h2>
                    <form action="{{ url('edit-customer/') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="customer_id" value="{{ isset($customer_id)?$customer_id:'' }}">
                        <input name="customer_email" value="{{ isset($customer_email)?$customer_email:'' }}" style="color:black;" readonly/>
                        <input type="password" name="customer_old_password"  placeholder="mật khẩu cũ" style="color:black;" required>
                        <div style="padding-bottom: 8px; color:red;">
                            @if(session('error')) {{ session('error') }} @endif
                        </div>
                        <div style="padding-bottom: 5px" class="text-info">
                            * mật khẩu không chứa ký tự đặc biệt, độ dài 3-30 ký tự.
                        </div>
                        <input type="password" id="pass1" name="customer_password"  placeholder="mật khẩu mới" style="color:black;" required>
                        <input type="password" id="pass2" name="customer_re_password" placeholder="nhập lại mật khẩu" style="color:black;" required/>
                        <div style="padding-bottom: 8px; color:red;" id="in"></div>
                        <button type="submit" class="btn btn-info" onclick="return check()">Thực hiện</button>
                    </form>
                </div><!--/sign up form-->
            </div>
                @endif
        </div>

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


@endsection
