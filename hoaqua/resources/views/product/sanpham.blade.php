<!DOCTYPE html>
<html>
<head>
	<title>Thêm/Sửa Danh Mục Sản Phẩm</title>
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
	    <a class="nav-link" href="/nguoidung">Quản Lý Người Dùng</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" href="/admin/category/danhsach">Quản Lý Danh Mục</a>
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
      <h1>Danh sách sản phẩm</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class=" table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                         <th>Tên sản phẩm</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Loại</th>
                        <th>Đơn vị</th>
                        <th>Hình ảnh</th>
                        <th colspan=2 >Chức năng</th>

                    </tr>
                </thead>
                <a href="{{ route('product.getProAdd') }}" class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</a>
                 @isset($products)
                <tbody>
				    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->category ? $product->category->name : 'Fail' }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->unit_price}}</td>
                        <td>{{ $product->new}}</td>
                        <td>{{ $product->unit}}</td>

                        <td><img width="260" height="260" src="{{ asset('source/image/product/' . $product->image) }}" alt=""></td>

                        <td>
                        
                        <a href="{{ route('product.postProEdit', ['id' => $product->id]) }}" class="btn btn-primary">Sửa</a>
                        </td>
                        <td>
                        <form action="{{ route('product.getProDelete', $product->id) }}" method="POST">
                        @csrf                       
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                        </td>

                          

                        </td>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                @endisset
            </table>
        </div>
    </div>
</div>

</body>
</html>







