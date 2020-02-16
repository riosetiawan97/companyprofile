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
    <li class="breadcrumb-item active">Overview</li>
  </ol>

  <!-- Icon Cards-->
  <div class="row">
    <div class="col-md-8">
      <form method="post" action="{{ route('kategori.update', $kategori->id) }}" >
      <input type="hidden" name="_token" value="{{ csrf_token() }}">      
      <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
          <label>Kategori</label>
          <input class="form-control {{ $errors->has('nama') ? 'is-invalid':'' }}" name="nama"  id="nama" value="{{ $kategori->nama }}" placeholder="Nama">
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <input class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}" name="deskripsi" id="deskripsi" value="{{ $kategori->deskripsi }}" placeholder="Deskripsi">
        </div>
        <div class="form-group">
          <label for="exampleFormControlSelect1">Flag Active</label>
          <select class="form-control" id="exampleFormControlSelect1" name="flag_active">
            <option value="Y" {{ $kategori->flag_active == 'Y' ? 'selected' : '' }}>Yes</option>
            <option value="N" {{ $kategori->flag_active == 'N' ? 'selected' : '' }}>No</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection