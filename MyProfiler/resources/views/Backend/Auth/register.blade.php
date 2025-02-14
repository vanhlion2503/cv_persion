<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Register</title>

    <link href="Backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="Backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="Backend/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="Backend/css/animate.css" rel="stylesheet">
    <link href="Backend/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen   animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">IN+</h1>

            </div>
            <h3>Đăng ký tài khoản</h3>
            <p>Hãy nhập thông tin vào đây.</p>
            <form class="m-t" role="form" action="{{ route('auth.register') }}" method="POST">
            @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tên đăng nhập" required="" name="name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" required="" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Mật khẩu"  name="password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Đăng ký</button>

                <p class="text-muted text-center"><small>Bạn đã có tài khoản?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{route('auth.admin') }}">Đăng nhập</a>
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="Backend/js/jquery-3.1.1.min.js"></script>
    <script src="Backend/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="Backend/js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>
