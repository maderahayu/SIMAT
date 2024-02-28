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

                <div class="card pb-1 mb-2">
                    <div class="card-body pt-4 row">
                        <form action="{{ route('logbookStore') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleDataList" class="form-label">Tugas</label>
                                <input class="form-control" name="tugasId" list="tugas" placeholder="Ketik untuk mecari ..." required>
                                <datalist id="tugas">
                                    @foreach($tugas as $tg)
                                    <option value="{{ $tg->judul}}">
                                        @endforeach
                                </datalist>
                            </div>

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tglLogbook" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Contoh: Membuat feed instagram bertemakan kemerdekaan untuk menyambut 17 agustus" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Status Tugas</label>
                                <select name="status" class="form-control" required>
                                    <option style="display:none">Pilih Status Tugas</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Lampiran</label>
                                <input type="file" name="lampiran" class="form-control">
                            </div>

                            <div class="text-center">
                                <a class="btn btn-secondary" href="{{ route('logbookIndex') }}" style="height:40px;width:200px"><i class="fas fa-chevron-circle-left fa-lg" style="margin-right:20px"></i>Kembali</a>
                                <button type="submit" class="btn btn-primary" style="height:40px;width:200px"><i class="fas fa-save fa-lg" style="margin-right:20px"></i>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <@include('layouts.footer')
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