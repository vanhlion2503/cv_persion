<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY - PROFILER </title>
    <link href="Backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="Backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="Backend/css/animate.css" rel="stylesheet">
    <link href="Backend/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h1 class="font-bold">WELCOME MY FROFILER</h1>
                <p>
                    Nền tảng tạo và chia sẻ hồ sơ cá nhân chuyên nghiệp, giúp bạn xây dựng CV dưới dạng portfolio trực tuyến một cách dễ dàng. Với giao diện trực quan là một trang web đặc biệt để quảng bá bản thân.
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" class="m-t" role="form" action="{{route('auth.login')}}">
                        @csrf
                        <div class="form-group">
                            <input 
                            type="email" 
                            name="email"
                            class="form-control" 
                            placeholder="Email"
                            >
                        </div>
                        <div class="form-group">
                            <input 
                            type="password" 
                            name="password"
                            class="form-control" 
                            placeholder="Mật khẩu" >
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>
                        <p class="text-muted text-center">
                            <small>Bạn chưa có tài khoản?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="{{ route('auth.register') }}">Đăng ký tài khoản</a>
                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
        </div>
    </div>

</body>

</html>
