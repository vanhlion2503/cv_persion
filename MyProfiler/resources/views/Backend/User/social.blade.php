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
                        <div class="dropdown profile-element"><span>
                                <img alt="image" class="img-circle" src="{{ Auth::user()->image ?? asset('default-avatar.jpg') }}" width="30" height="30"/>
                                </span>
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
                            <li><a href="{{route('user.index')}}">Thông tin cơ bản</a></li>
                            <li class="active"><a href="{{route('social-links.index')}}">Mạng xã hội</a></li>
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
        <div id="page-wrapper" class="gray-bg">
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
                    <li class="active"><strong>Mạng xã hội</strong></li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div class="mt-4 white-bg card">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Liên Kết Mạng Xã Hội</h2>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th>Icon</th>
                                    <th>URL</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($links as $link)
                                    <tr>
                                        <td class="fs2">{{ $link->name }}</td>
                                        <td class="fs2"><i class="{{ $link->icon }} pl20"></i></td>
                                        <td><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
                                        <td class="button-group">
                                            <button class="btn btn-warning btn-sm" onclick="editLink(this)" 
                                                    data-id="{{ $link->id }}" 
                                                    data-name="{{ $link->name }}" 
                                                    data-icon="{{ $link->icon }}" 
                                                    data-url="{{ $link->url }}">
                                                Sửa
                                            </button>
                                            <form action="{{ route('social-links.destroy', $link->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <h3 id="form-title">Thêm Liên Kết</h3>
                        <form id="social-form" action="{{ route('social-links.store') }}" method="POST">
                            @csrf
                            <input type="hidden" id="social-id" name="id">
                            <div class="mb-3">
                                <label class="form-label">Chọn Icon Mạng Xã Hội</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="selected-icon" class="fab fa-facebook"></i></span>
                                    <select id="icon" name="icon" class="form-select " required onchange="updateIcon()">
                                        <option value="fab fa-facebook" data-name="Facebook" selected>Facebook</option> <!-- Facebook Icon -->
                                        <option value="fab fa-twitter" data-name="Twitter">Twitter</option> <!-- Twitter Icon -->
                                        <option value="fab fa-instagram" data-name="Instagram">Instagram</option> <!-- Instagram Icon -->
                                        <option value="fab fa-youtube" data-name="YouTube">Youtobe</option> <!-- YouTube Icon -->
                                        <option value="fab fa-linkedin" data-name="LinkedIn">LinkedIn</option> <!-- LinkedIn Icon -->
                                        <option value="fab fa-tiktok" data-name="TikTok">TikTok</option> <!-- TikTok Icon -->
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="name" id="name" value="Facebook">
                            <div class="mb-3" style="margin-bottom: 10px;">
                                <label class="form-label">URL</label>
                                <input type="url" name="url" id="url" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">Hủy</button>
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
        function updateIcon() {
            let iconSelect = document.getElementById("icon");
            let selectedOption = iconSelect.options[iconSelect.selectedIndex];

            // Cập nhật icon hiển thị
            let selectedIconClass = selectedOption.value;
            document.getElementById("selected-icon").className = selectedIconClass;

            // Tự động cập nhật tên mạng xã hội vào input ẩn
            let socialName = selectedOption.getAttribute("data-name");
            document.getElementById("name").value = socialName;
        }
        function editLink(button) {
            document.getElementById('form-title').innerText = 'Cập nhật Liên Kết';
            document.getElementById('social-form').action = `/social/update/${button.getAttribute('data-id')}`;
            document.getElementById('social-id').value = button.getAttribute('data-id');

            // Đặt giá trị icon
            let iconValue = button.getAttribute('data-icon');
            document.getElementById('icon').value = iconValue;
            document.getElementById('selected-icon').className = iconValue;

            // Cập nhật tên từ data-name
            let socialName = button.getAttribute('data-name');
            document.getElementById('name').value = socialName;

            document.getElementById('url').value = button.getAttribute('data-url');
        }
        function resetForm() {
            document.getElementById('form-title').innerText = 'Thêm Liên Kết';
            document.getElementById('social-form').action = "{{ route('social-links.store') }}";
            document.getElementById('social-id').value = '';
            
            // Reset icon và tên về Facebook mặc định
            document.getElementById('icon').value = 'fab fa-facebook';
            document.getElementById('selected-icon').className = 'fab fa-facebook';
            document.getElementById('name').value = 'Facebook';
            
            document.getElementById('url').value = '';
        }

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
