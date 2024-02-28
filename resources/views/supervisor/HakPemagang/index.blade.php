@extends('layouts.app')

@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SiMaT</div>
        </a>

        
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Data Magang
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Data Magang
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item ">
            <a class="nav-link" href="{{ route('daftarAnakMagang') }}">
                <i class="fas fa-users"></i>
                <span>Daftar Anak Magang</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('task.index')}}">
                <i class="fas fa-tasks"></i>
                <span>Tugas Anak Magang</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('evaluasi.index') }}">
                <i class="fas fa-star-half-alt"></i>
                <span>Evaluasi Anak Magang</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('kelompok.index') }}">
                <i class="fas fa-user-friends"></i>
                <span>Daftar Kelompok Magang</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Hak Akses
        </div>
        <!-- Nav Item - Charts -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('createPemagang') }}">
                <i class="fas fa-users-cog"></i>
                <span>Hak Akses User</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">


        <!-- Main Content -->
        <div id="content">

            @include('layouts.nav')
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Hak Akses Anak Magang</h1>
                <div class="card shadow mb-4 bg-light">
                    <div class="card-body row">
                        <!-- This is some text within a card body. -->
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="col-md-5 mr-4 ml-5">
                            <form action="{{ route('sup.buatAkunAnakMagang') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="namaPemagang" class="form-control" placeholder="Contoh: John Doe">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Contoh: John@example.com">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Nama Universitas</label>
                                    <input type="text" name="namaUniversitas" class="form-control" placeholder="Contoh: Universitas Indonesia">
                                </div>
                        </div>
                        <div class="col-md-5 ml-4">
                            <div class="mb-4">
                                <label for="exampleDataList" class="form-label">Kelompok</label>
                                <input class="form-control" name="kelompokId" list="kelompok" id="exampleDataList" placeholder="Type to search...">
                                <datalist id="kelompok">
                                    @foreach($kelompok as $k)
                                        <option value="{{ $k}}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Tanggal Mulai Magang</label>
                                <input type="date" name="tglMulai" class="form-control" placeholder="Contoh: John@example.com">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Tanggal Selesai Magang</label>
                                <input type="date" name="tglSelesai" class="form-control" placeholder="Contoh: John@example.com">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary pr-5"><i class="fas fa-save fa-lg" style="margin-right:30px;"></i>Simpan</button>
                        </div>
                        </form>
                    </div>

                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Wrapper -->
@endsection