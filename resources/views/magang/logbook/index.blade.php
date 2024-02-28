@extends('layouts.app')

@section('content')
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Mahasiswa Magang
        </div>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tugasIndex') }}">
            <i class="fas fa-fw fa-list"></i>
                <span>Tugas</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link active" href="{{ route('logbookIndex') }}">
            <i class="fas fa-fw fa-cog"></i>
                <span>Logbook Magang</span></a>
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

        <!-- Topbar Navbar -->
        @include('layouts.nav')
            
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Logbook Anak Magang</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">
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
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('logbookCreate')}}" class="btn btn-primary mb-3"><i class="fas fa-plus" style="margin-right: 10px;"></i>Buat Logbook</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="table-secondary">
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Tugas</th>
                                        <th scope="col" class="text-center">Deskripsi</th>
                                        <th scope="col" class="text-center">Tanggal Logbook</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logbook as $log)
                                    <tr>
                                        <th scope="row" class="text-center">{{ $loop->iteration}}</th>
                                        <td>{{ $log->task->judul }}</td>
                                        <td>{{ $log->deskripsi }}</td>
                                        <td class="text-center">{{$log->tglLogbook}}</td>
                                        <td class="text-center" style="width: 15%">
                                            <a class="btn btn-success" href="{{ route('logbookEdit', $log->logbookId) }}" role="button" style="margin-right:5px"><i class="fa fa-pen"></i></a>
                                            <a class="btn btn-danger" href="{{ route('logbookDelete', $log->logbookId) }}" role="button" onclick="return confirm('Apakah Anda Yakin Menghapus Data?');"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; SimaT 2023</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

@include('layouts.logoutModels')

</div>
</div>


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- @include('layouts.logoutModels') -->




@endsection