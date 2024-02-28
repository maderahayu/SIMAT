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
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
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
        <li class="nav-item active">
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
        <li class="nav-item">
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
                <h1 class="h3 mb-4 text-gray-800">Tugas Anak Magang</h1>
                <div class="card shadow mb-4 bg-light">
                    <div class="card-body">
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
                        <a href="{{ route('task.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus" style="margin-right: 10px;"></i>Buat Tugas</a>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $task->judul }}</td>
                                        <td>{{ $task->deskripsi }}</td>
                                        <td class="tex-center">{{ $task->status }}</td>
                                        <td class="tex-center">{{ $task->tglMulai  }}</td>
                                        <td class="tex-center">{{ $task->tglSelesai }}</td>
                                        <td class="text-center" style="width:90px">
                                            <a class="btn btn-success" href="{{ route('task.edit', $task->tugasId) }}" role="button"><i class="fa fa-pen"></i></a>
                                            <a class="btn btn-danger" href="{{ route('task.destroy', $task->tugasId) }}" role="button" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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