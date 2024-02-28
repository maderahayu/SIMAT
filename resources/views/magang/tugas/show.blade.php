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
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('tugasIndex') }}">
                <i class="fas fa-fw fa-list"></i>
                <span>Tugas</span></a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('logbookIndex')}}">
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
                <h1 class="h3 mb-4 text-gray-800">Detail Tugas</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <a href="{{ route('tugasIndex') }}" style="height:40px;width:200px"><i class="fas fa-chevron-circle-left fa-lg" style="margin-right:20px"></i>Kembali</a>
                        
                        <h4>Detail Tugas</h4>
                        <div class="form-group">
                            <label>Tugas</label>
                            <input type="input" value="{{$tg->judul}}" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Tugas</label>
                            <input type="input" value="{{$supervisor->namaSupervisor}}" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <input type="input" value="{{$tg->status}}" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" readonly>{{$tg->deskripsi}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Mulai</label>
                            <input type="date" value="{{$tg->tglMulai}}" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Selesai (Estimasi)</label>
                            <input type="date" value="{{$tg->tglSelesai}}" class="form-control" readonly>
                        </div>

                        <br>
                        <h4>Detail Evaluasi</h4>
                        @if($evaluasi)
                        @foreach($evaluasi as $e)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Penilaian</th>
                                    <th scope="col">Komentar</th>
                                    <th scope="col">Tanggal Evaluasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th style="width:3%">{{$loop->iteration}}</th>
                                    <td>{{$e->penilaiaan}}</td>
                                    <td>{{$e->komentar}}</td>
                                    <td>{{$e->tglEvaluasi}}</td>
                                </tr>
                            </tbody>
                        </table>
                        @endforeach
                        @else
                        <p>Belum ada evaluasi</p>
                        @endif

                        <h4>Logbook</h4>
                        @if($logbook)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width:80%">Deskripsi</th>
                                    <th scope="col">Tanggal Logbook</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($logbook as $l)
                                    <tr>
                                        <th style="width:3%">{{$loop->iteration}}</th>
                                        <td>{{$l->deskripis}}</td>
                                        <td>{{$l->tglLogbook}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                        <p>Belum ada Logbook</p>
                        @endif
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        @include('layouts.footer')
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