<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIONFASHION | Đăng nhập </title>
    <link href="Backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="Backend/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="Backend/css/animate.css" rel="stylesheet">
    <link href="Backend/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Welcome to IN+</h2>
                <p>
                    Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                </p>

                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>

                <p>
                    When an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </p>

                <p>
                    <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
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
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2024-2025</small>
            </div>
        </div>
    </div>

</body>

</html>
