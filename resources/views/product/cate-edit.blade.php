<!doctype html>
<html lang="en">
<head>
  <title>Sửa sản phẩm</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <h2>Sửa sản phẩm</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('product.postCateEdit', $category->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div class="form-group">
      <label for="name">Tên sản phẩm</label>
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nhập tên sản phẩm" value="{{ old('name', $category->name) }}">

      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="description">Mô tả</label>
      <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Nhập mô tả" value="{{ old('description', $category->description) }}">

      @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label for="image">Ảnh</label>
      <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
      <br>
      <img id="image-preview" src="{{ asset('source/image/product/' . $category->image) }}" alt="Ảnh xem trước" style="display:block; max-height: 200px;">
      @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <button type="submit" name="savebtn" class="btn btn-primary">Lưu thay đổi</button>
  </form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script>
document.getElementById("image").addEventListener("change", function() {
  var reader = new FileReader();
  reader.onload = function() {
    var output = document.getElementById("image-preview");
    output.src = reader.result;
    output.style.display = "block";
  }
  reader.readAsDataURL(event.target.files[0]);
});
</script>
</body>
</html>
