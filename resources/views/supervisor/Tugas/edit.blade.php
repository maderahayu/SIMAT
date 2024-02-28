@extends('layouts.app')

@section('content')
<!-- Page Wrapper -->
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
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('home') }}">
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

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Edit Tugas Anak Magang</h1>


                <div class="card pb-1 mb-2">
                    <div class="card-body pt-4 row">
                        @foreach($tugas as $t)
                        <div class="card-body">
                            <form action="{{ route('task.update', $t->tugasId) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" class="form-control" value="{{ $t->judul }}">
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="4" required>{{ $t->deskripsi }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="kelompok">Kelompok</label>
                                    <select name="kelompokId" class="form-control">
                                        @foreach($kelompok as $kel)
                                        @if($kel->kelompokId == $t->kelompokId)
                                        <option value="{{$kel->kelompokId}}" selected>{{ $kel->namaKelompok }}</option>
                                        @else
                                        <option value="{{$kel->kelompokId}}">{{$kel->namaKelompok}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="supervisor">Supervisor</label>
                                    <select name="supervisorId" class="form-control">
                                        @foreach($supervisor as $sup)
                                        @if($sup->supervisorId == $t->supervisorId)
                                        <option value="{{$sup->supervisorId}}" selected>{{ $sup->namaSupervisor }}</option>
                                        @else
                                        <option value="{{$sup->supervisorId}}">{{$sup->namaSupervisor}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tglMulai">Tanggal Mulai</label>
                                    <input type="date" name="tglMulai" class="form-control" value="{{ $t->tglMulai }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="tglSelesai">Tanggal Selesai</label>
                                    <input type="date" name="tglSelesai" class="form-control" value="{{ $t->tglSelesai }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Lampiran</label>
                                    <input type="file" name="lampiran" class="form-control">
                                    @foreach($lampiran as $l)
                                        <a href="{{ asset('storage/file/' . $l->namaFile) }}" target="_blank">
                                        {{ File::basename($l->namaFile) }}
                                        </a> <br>
                                    @endforeach
                                 </div>
                               

                                <div class="col-md-12 text-center">
                                    <a class="btn btn-secondary" href="{{ route('task.index') }}" style="height:40px;width:200px"><i class="fas fa-chevron-circle-left fa-lg" style="margin-right:20px"></i>Kembali</a>
                                    <button type="submit" class="btn btn-primary" style="height:40px;width:200px"><i class="fas fa-save fa-lg" style="margin-right:20px"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
                        @endforeach
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
@endsection