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
        <li class="nav-item active">
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
                <h1 class="h3 mb-4 text-gray-800">Edit Anak Magang</h1>

                
            <div class="card pb-1 mb-2">
            <div class="card-body pt-4 row">
            @foreach($magang as $mg)
            <form method="post" action="{{route('sup.updateDataMagang', $mg->pemagangId)}}" enctype="multipart/form-data" class="form-group row">
            @csrf
            @method('PUT')
                <div class="col-md-5">
                    <img src="{{ asset('storage/images/'.$mg->fotoProfil) }}" class="rounded" height="50%" width="90%" alt="...">
                    <input type="file" class="form-control col-md-8 mt-3" name="fotoProfil" value="{{ $mg->fotoProfil }}">
                    <!-- <label for=""> {{ $mg->fotoProfil }}</label> -->
                </div>
                <div class="col-md-6 pt-1">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" name="namaPemagang" class="form-control" value="{{$mg->namaPemagang}}" placeholder="Masukkan nama anda..." require disabled>
                    </div>
                    <div class="mb-3">
                        <label for="univ" class="form-label">Universitas</label>
                        <input type="text" name="namaUniversitas" class="form-control" value="{{$mg->namaUniversitas}}" placeholder="Masukkan universitas anda ..." require disabled>
                    </div>
                    <div class="mb-3">
                        <label for="kelompok" class="form-label">Kelompok Magang</label>
                        @foreach($kelompok as $k)
                        <input type="text" class="form-control" value="{{$k->namaKelompok}}" require disabled>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <label for="supervisor" class="form-label">Supervisor Magang</label>
                        <select name="supervisorId" class="form-control">
                            @foreach($supervisor as $sup) 
                                @if($sup->supervisorId == $mg->supervisorId)
                                    <option value="{{$sup->supervisorId}}" selected>{{ $sup->namaSupervisor }}</option>
                                @else
                                    <option value="{{$sup->supervisorId}}">{{$sup->namaSupervisor}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" value="{{$mg->noTelp}}" require disabled>
                    </div>
                    <div class="mb-3">
                        <label for="tglMulai" class="form-label">Tanggal Mulai</label>
                        <input type="text" name="tglMulai" class="form-control" value="{{ $mg->tglMulai->format('d/m/Y') }}" disabled require>
                    </div>
                    <div class="mb-3">
                        <label for="tglSelesai" class="form-label">Tanggal Selesai</label>
                        <input type="text" name="tglSelesai" class="form-control" value="{{ $mg->tglSelesai->format('d/m/Y') }}" disabled require>
                    </div>
                    <div class="col-md-12 text-center">
                        <a class="btn btn-secondary" href="{{ route('daftarAnakMagang') }}" style="height:40px;width:200px"><i class="fas fa-chevron-circle-left fa-lg" style="margin-right:20px"></i>Cancel</a>
                        <button type="submit" class="btn btn-primary" style="height:40px;width:200px"><i class="fas fa-save fa-lg" style="margin-right:20px"></i> Simpan</button>
                    </div>
            </form>
        </div>
        @endforeach


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