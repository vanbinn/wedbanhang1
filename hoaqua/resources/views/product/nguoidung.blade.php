<!DOCTYPE html>
<html>
<head>
	<title>Thêm/Sửa Người Dùng</title>
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
	    <a class="nav-link" href="/banner">Quản Lý Banner</a>
	  </li>
	</ul>
    <div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    <div class="col-12 text-center">
      <h1>Danh sách người dùng</h1>
    </div>
    <div class="row">
    <table class="table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Level</th>
                        <th colspan=2 >Chức năng</th>

                    </tr>
                </thead>
                <a href="{{ route('product.getUserAdd') }}" class="btn btn-success" style="margin-bottom: 15px;">Thêm Người Dùng</a>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->level->name }}</td>
 
                    <td>
                        <a href="{{ route('product.getUserEdit', ['id' => $user->id]) }}" class="btn btn-primary">Sửa</a>
                    </td>
                    <td>
                        <form action="{{ route('product.getUserDelete', $user->id) }}" method="POST">
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







