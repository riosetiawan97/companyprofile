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
            <form method="post" action="{{ route('posting.update', $posting->kategori) }}" >
              <input type="hidden" name="_token" value="{{ csrf_token() }}">      
              <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
            @if ($posting->kategori == 'au')
              <label>{{ $kategori->deskripsi }}</label>
              <textarea name="posting" class="form-control" rows="10" required>{{ $posting->isi }}</textarea>
              @else
              <label>{{ $kategori->deskripsi }}</label>
              <input class="form-control {{ $errors->has('posting') ? 'is-invalid':'' }}" name="posting"  id="posting" placeholder="Nomor Telepon" value='{{ $posting->isi }}'>
              @endif
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
          </form>
            </div>
        </div>

</div>
<!-- /.container-fluid -->
 @endsection