<!DOCTYPE html>
<html>
<head>
	<title>Thêm/Sửa Banner</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<ul class="nav nav-tabs">
	  <li class="nav-item">
      <a class="nav-link" href="/admin/category/danhsach">Quản Lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="/sanpham">Quản Lý Sản Phẩm</a>
	  </li>
      <li class="nav-item">
	    <a class="nav-link" href="/nguoidung">Quản Lý Người Dùng</a>
	  </li>
	</ul>
    <div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    <div class="col-12 text-center">
      <h1>Danh sách banner</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                         <th>Link</th>
                        <th>Hình ảnh</th>
                        <th colspan=2 >Chức năng</th>

                    </tr>
                </thead>
                <a href="{{ route('product.postBanAdd') }}" class="btn btn-success" style="margin-bottom: 15px;">Thêm Banner</a>

                <tbody>
                    @foreach($slide as $slide)
                    <tr>
                        <td>{{ $slide->id }}</td>
                        <td>{{ $slide->link }}</td>
                         <td><img width="400" height="280" src="{{ asset('source/image/slide/' . $slide->image) }}" alt=""></td>

                        <td>
                        
                            <a href="{{ route('product.getBanEdit', ['id' => $slide->id]) }}" class="btn btn-primary">Sửa</a>
                        </td>
                        <td>
                        <form action="{{ route('product.getBanDelete', $slide->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                        </td>
                    </tr>
 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>







