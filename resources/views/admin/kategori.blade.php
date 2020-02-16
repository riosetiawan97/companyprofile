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
    <li class="breadcrumb-item active">Kategori Isi</li>
  </ol>

  <!-- Icon Cards-->
  <div class="row">
    <div class="col-md-8">
      <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm mb-4"><i class="fas fa-plus"></i> Add</a>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @php
          $no = 1;
          @endphp
          @if (count($categories) < 1) <tr>
            <td colspan="4" class="text-center">Data not found</td>
            </tr>
            @else
            @foreach($categories as $row)
            <tr>
              <th scope="row">{{ $no++ }}</th>
              <td>{{ $row->nama }}</td>
              <td>{{ $row->deskripsi }}</td>
              <td>{{ $row->flag_active == 'Y' ? 'Yes' : 'No' }}</td>
              <td>
                <form action="{{ route('kategori.destroy', $row->id) }}" method="POST">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                  <a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                  <button class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>&nbsp;Delete
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
            @endif
        </tbody>
      </table>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection