@extends('layout.masteradmin')
@section('title')
<title>SB Admin - Dashboard</title>
@endsection

@section('content')
<div class="container-fluid">

  <!-- Breadcrumbs-->
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Tambah Produk</li>
  </ol>

  <!-- Icon Cards-->
  <div class="row">
    <div class="col-md-8">
      <form method="post" action="{{ route('produk.store') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label>Kategori</label>
          <input class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" name="nama" id="nama" placeholder="Nama">
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" name="deskripsi" rows="4" placeholder="Deskripsi"></textarea>
        </div>
        <div class="form-group">
          <label for="image">Gambar Produk</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
              <input type="file" class="custom-file-input {{ $errors->has('gambar') ? 'is-invalid':'' }}" id="fileimage" name="gambar">
              <label class="custom-file-label" for="fileimage">Choose file</label>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection