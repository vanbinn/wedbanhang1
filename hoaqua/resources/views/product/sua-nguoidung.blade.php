<!doctype html>
<html lang="en">
<head>
  <title>Sửa thông tin người dùng</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta full_name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <h2>Sửa thông tin người dùng</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif


  <form action="{{ route('product.postUserEdit', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
      <label for="level">Chọn level</label>
      <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
        <option value="">-- Chọn level --</option>
        @foreach($levels as $level)
          <option value="{{ $level->id }}" {{ old('level', $user->id_level) == $level->id ? 'selected' : '' }}>
            {{ $level->name }}
          </option>
        @endforeach
      </select>
      @error('level')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="full_name">Tên người dùng</label>
      <input type="text" name="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Nhập tên" value="{{ old('full_name', $user->full_name) }}"> 
      @error('full_name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="email">Email</label>
<input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Nhập email" value="{{ old('email', $user->email) }}">
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
  <label for="password">Password</label>
  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Nhập password" value="{{ old('password', $user->password) }}">
  @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
  @enderror
</div>


    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Nhập số điện thoại" value="{{ old('phone', $user->phone) }}">
      @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="address">Địa chỉ</label>
      <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Nhập địa chỉ" value="{{ old('address', $user->address) }}">
      @error('address')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" name="savebtn" class="btn btn-primary">Lưu thay đổi</button>
  </form>
</div>


 
</body>
</html>
