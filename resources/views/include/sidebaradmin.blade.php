<!-- Sidebar -->
<ul class="sidebar navbar-nav">
      <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home.index') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('kategori.index') }}">
          <i class="fas fa-fw fa-align-left"></i>
          <span>Kategori Isi</span></a>
      </li>
      @if (count($kategorimenu) > 0)
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Isi</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        @foreach($kategorimenu as $row)
          <a class="dropdown-item" href="{{ route('posting.edit', $row->nama) }}">{{ $row->deskripsi }}</a>  
        @endforeach
        </div>
      </li>
      @endif
      <li class="nav-item">
        <a class="nav-link" href="{{ route('produk.index') }}">
        <i class="fab fa-fw fa-product-hunt"></i>
          <span>Produk</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>
    </ul>