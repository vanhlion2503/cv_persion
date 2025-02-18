<!DOCTYPE html>
<html>

<head>
    <base href="{{env('APP_URL') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYFROFILE | ADMIN</title>
    <link href="{{ asset('Backend\css\bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Backend\font-awesome\css\font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('Backend\css\animate.css') }}" rel="stylesheet">
    <link href="{{ asset('Backend\css\style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Backend\css\style.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('Backend/css/table.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
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
                            <li><a href="{{route('social-links.index')}}">Mạng xã hội</a></li>
                            <li class="active"><a href="{{route('other.index')}}">Thông tin khác</a></li>
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
                    <li class="active"><strong>Thông tin khác</strong></li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div>
                <h1>Cập nhật học vấn</h1>
                <form method="POST" action="{{ route('resume.store') }}">
                    @csrf
                    <input type="text" name="name" placeholder="Tên trường" required>
                    <input type="text" name="start_year" placeholder="Năm bắt đầu" required>
                    <input type="text" name="end_year" placeholder="Năm kết thúc">
                    <textarea name="description" placeholder="Mô tả"></textarea>
                    <button type="submit">Thêm</button>
                </form>
                <hr>
                <!-- Bảng để Hiển thị Resumes -->
                <table border="1">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Năm bắt đầu</th>
                            <th>Năm kết thúc</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resumes as $resume)
                        <tr id="row-{{ $resume->id }}">
                            <td class="editable" data-field="name">{{ $resume->name }}</td>
                            <td class="editable" data-field="start_year">{{ $resume->start_year }}</td>
                            <td class="editable" data-field="end_year">{{ $resume->end_year }}</td>
                            <td class="editable" data-field="description">{{ $resume->description }}</td>
                            <td class="actions">
                                <!-- Nút để bật chế độ chỉnh sửa -->
                                <button onclick="enableEditMode('{{ $resume->id }}')">Cập nhật</button>

                                <!-- Form để xóa -->
                                <form action="{{ route('resume.destroy', $resume) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete">Xóa</button>
                                </form>

                                <!-- Nút để lưu thay đổi (ban đầu ẩn) -->
                                <button id="save-btn-{{ $resume->id }}" onclick="saveChanges('{{ $resume->id }}')" style="display:none;">Lưu</button>
                                <button id="cancel-btn-{{ $resume->id }}" onclick="cancelEdit('{{ $resume->id }}')" style="display:none;">Hủy</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
        function enableEditMode(id) {
            // Lấy hàng cần chỉnh sửa
            var row = document.getElementById('row-' + id);
            
            // Lấy tất cả các ô có thể chỉnh sửa
            var editableCells = row.querySelectorAll('.editable');
            
            // Thay đổi các ô thành các ô nhập liệu
            editableCells.forEach(function(cell) {
                var field = cell.getAttribute('data-field');
                var value = cell.innerText;
                cell.innerHTML = '<input type="text" name="' + field + '" value="' + value + '">';
            });
            
            // Hiển thị nút lưu và hủy, ẩn nút cập nhật và xóa
            document.getElementById('save-btn-' + id).style.display = 'inline';
            document.getElementById('cancel-btn-' + id).style.display = 'inline';
            row.querySelector('button[onclick^="enableEditMode"]').style.display = 'none';
            row.querySelector('form').style.display = 'none';
        }

        function saveChanges(id) {
            // Lấy hàng cần lưu thay đổi
            var row = document.getElementById('row-' + id);
            
            // Lấy tất cả các ô có thể chỉnh sửa
            var editableCells = row.querySelectorAll('.editable');
            
            // Lưu giá trị mới từ các ô nhập liệu
            editableCells.forEach(function(cell) {
                var input = cell.querySelector('input');
                if (input) {
                    cell.innerText = input.value;
                }
            });
            
            // Ẩn nút lưu và hủy, hiển thị nút cập nhật và xóa
            document.getElementById('save-btn-' + id).style.display = 'none';
            document.getElementById('cancel-btn-' + id).style.display = 'none';
            row.querySelector('button[onclick^="enableEditMode"]').style.display = 'inline';
            row.querySelector('form').style.display = 'inline';
        }

        function cancelEdit(id) {
            // Lấy hàng cần hủy chỉnh sửa
            var row = document.getElementById('row-' + id);
            
            // Lấy tất cả các ô có thể chỉnh sửa
            var editableCells = row.querySelectorAll('.editable');
            
            // Khôi phục giá trị ban đầu từ các ô nhập liệu
            editableCells.forEach(function(cell) {
                var input = cell.querySelector('input');
                if (input) {
                    cell.innerText = input.defaultValue;
                }
            });
            
            // Ẩn nút lưu và hủy, hiển thị nút cập nhật và xóa
            document.getElementById('save-btn-' + id).style.display = 'none';
            document.getElementById('cancel-btn-' + id).style.display = 'none';
            row.querySelector('button[onclick^="enableEditMode"]').style.display = 'inline';
            row.querySelector('form').style.display = 'inline';
        }
    </script>

    <!-- Mainly scripts -->
    <script src="{{ asset('Backend/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('Backend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Flot -->
    <script src="{{ asset('Backend/js/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/flot/jquery.flot.spline.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/flot/jquery.flot.symbol.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/flot/jquery.flot.time.js') }}"></script>

    <!-- Peity -->
    <script src="{{ asset('Backend/js/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ asset('Backend/js/demo/peity-demo.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('Backend/js/inspinia.js') }}"></script>
    <script src="{{ asset('Backend/js/plugins/pace/pace.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('Backend/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Jvectormap -->
    <script src="{{ asset('Backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- EayPIE -->
    <script src="{{ asset('Backend/js/plugins/easypiechart/jquery.easypiechart.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('Backend/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Sparkline demo data -->
    <script src="{{ asset('Backend/js/demo/sparkline-demo.js') }}"></script>
</body>
</html>
