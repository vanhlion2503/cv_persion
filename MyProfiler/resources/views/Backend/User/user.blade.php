<!DOCTYPE html>
<html>

<head>
    <base href="{{env('APP_URL') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYFROFILE | ADMIN</title>
    <link href="Backend\css\bootstrap.min.css" rel="stylesheet">
    <link href="Backend\font-awesome\css\font-awesome.css" rel="stylesheet">
    <link href="Backend\css\animate.css" rel="stylesheet">
    <link href="Backend\css\style.css" rel="stylesheet">
    <link rel="stylesheet" href="Backend\css\style.css">
    <link rel="stylesheet" href="Backend/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src=" {{ Auth::user()->image ?? asset('default-avatar.jpg') }}" width="30" height="30"/>

                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ $user->name }}</strong>
                                </span> <span class="text-muted text-xs block">{{ $user->congviec }}</span> </span> </a>
                        </div>
                        <div class="logo-element">
                            CV
                        </div>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Thông tin cá nhân</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="{{route('user.index')}}">Thông tin cơ bản</a></li>
                            <li><a href="{{route('social-links.index')}}">Mạng xã hội</a></li>
                            <li><a href="{{route('other.index')}}">Thông tin khác</a></li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fas fa-book"></i><span class="nav-label">Quản lý nội dung</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{route('baiviet.index')}}">Quản lý bài viết</a></li>
                            <li><a href="{{route('anh.index')}}">Quản lý hình ảnh</a></li>  
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div id="page-wrapper" class="gray-bg" style="height: 1500px;">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Chào mừng đến với FROFILER Admin</span>
                    </li>
                    <li>
                        <a class="right-sidebar-toggle" href="{{route('showUser',['id' => $user->id])}}" target="_blank">
                            <i class="fa fa-file-alt"></i> Đến trang CV
                        </a>
                    </li>
                    <li>
                        <a href="{{route('auth.logout')}}">
                            <i class="fa fa-sign-out"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
        </nav>
        <div class="row wrapper border-bottom white-bg page-heading mx10">
            <div class = "col-lg-8">
                <h2>Thông tin cá nhân</h2>
                <ol class="breadcrumb" style="margin-bottom: 10px;">
                    <li>
                        <a href="{{route("darkboard.index")}}">Trang chủ</a>
                    </li>
                    <li class="active"><strong>Thông tin cơ bản</strong></li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div class="box">
                <h1>Thông tin cơ bản</h1>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="card white-bg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                @if($user->image)
                                    <img src="{{ Auth::user()->image ?? asset('default-avatar.jpg') }}" width="150" class="rounded-circle user-image">
                                @else
                                    <img src="default-avatar.png') }}" width="150" class="rounded-circle user-image">
                                @endif
                                <h4 class="mt-3">{{ $user->name }}</h4>
                            </div>
                            <div class="col-md-8">
                                <table class="table">
                                    <tr><th>Email:</th><td>{{ $user->email }}</td></tr>
                                    <tr><th>Số điện thoại:</th><td>{{ $user->phone ?? 'Chưa cập nhật' }}</td></tr>
                                    <tr><th>Địa chỉ:</th><td>{{ $user->address ?? 'Chưa cập nhật' }}</td></tr>
                                    <tr><th>Ngày sinh:</th><td>{{ $user->birthday ?? 'Chưa cập nhật' }}</td></tr>
                                    <tr><th>Công việc:</th><td>{{ $user->congviec ?? 'Chưa cập nhật' }}</td></tr>
                                    <tr><th>Giới thiệu:</th><td>{{ $user->gioithieu ?? 'Chưa cập nhật' }}</td></tr>
                                </table>
                                <button id="editProfileBtn" class="btn btn-primary">Sửa thông tin</button>
                            </div>
                        </div>
                        <form id="editProfileForm" method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data" class="mt-3 hidden">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên:</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address', $user->address) }}">
                            </div>
                            <div class="form-group">
                                <label for="birthday">Ngày sinh:</label>
                                <input type="date" class="form-control" name="birthday" value="{{ old('birthday', $user->birthday) }}">
                            </div>
                            <div class="form-group">
                                <label for="congviec">Công việc:</label>
                                <textarea class="form-control" name="congviec" id="congviec">{{ old('congviec', $user->congviec) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="gioithieu">Giới thiệu:</label>
                                <textarea class="form-control" name="gioithieu" id="gioithieu">{{ old('gioithieu', $user->gioithieu) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Ảnh đại diện:</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <button type="submit" class="btn btn-success">Lưu thay đổi</button>
                            <button type="button" id="cancelEditBtn" class="btn btn-secondary">Hủy</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                    <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>
        </div>
        </div>
    </div>
    <script>

        document.getElementById('editProfileBtn').addEventListener('click', function () {
            document.getElementById('editProfileForm').classList.remove('hidden');
            document.getElementById('editProfileBtn').classList.add('hidden');
        });
        document.getElementById('cancelEditBtn').addEventListener('click', function () {
            document.getElementById('editProfileForm').classList.add('hidden');
            document.getElementById('editProfileBtn').classList.remove('hidden');
        });
    </script>
    <!-- Mainly scripts -->
    <script src="Backend/js/jquery-3.1.1.min.js"></script>
    <script src="Backend/js/bootstrap.min.js"></script>
    <script src="Backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="Backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="Backend/js/plugins/flot/jquery.flot.js"></script>
    <script src="Backend/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="Backend/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="Backend/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="Backend/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="Backend/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="Backend/js/plugins/flot/jquery.flot.time.js"></script>

    <!-- Peity -->
    <script src="Backend/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="Backend/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="Backend/js/inspinia.js"></script>
    <script src="Backend/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="Backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- Jvectormap -->
    <script src="Backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- EayPIE -->
    <script src="Backend/js/plugins/easypiechart/jquery.easypiechart.js"></script>

    <!-- Sparkline -->
    <script src="Backend/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data -->
    <script src="Backend/js/demo/sparkline-demo.js"></script>
</body>
</html>
