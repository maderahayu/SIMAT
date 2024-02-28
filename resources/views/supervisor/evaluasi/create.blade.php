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
        <li class="nav-item active">
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
                <h1 class="h3 mb-4 text-gray-800">Buat Evaluasi Anak Magang</h1>


                <div class="card pb-1 mb-2">
                    <div class="card-body pt-2 row">
                        <div class="card-body">
                            <form action="{{ route('evaluasi.storeEvaluasi') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Pilih Tugas</label>
                                    <select id="task_id" name="task_id" class="form-control">
                                        <option style="display:none">Pilih Tugas</option>
                                        @foreach ($tugas as $task)
                                        <option value="{{ $task->tugasId }}" data-tugas-id="{{ $task->kelompokId }}">{{ $task->judul }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="status-section" class="form-group">
                                    <label for="intern_group">Kelompok</label>
                                    <input type="text" class="form-control" name="kelompok" id="intern_group" readonly>
                                </div>

                                <div id="status-section" class="form-group">
                                    <label>Status Tugas</label>
                                    <select name="status" class="form-control">
                                        <option style="display:none">Pilih Status Tugas</option>
                                        <option value="Revisi">Revisi</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Penilaian</label>
                                    <input type="text" name="penilaian" placeholder="Contoh: 95 atau A" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Komentar</label>
                                    <textarea name="Komentar" class="form-control" placeholder="Contoh: Desain feednya buat menggunakan warna merah dan biru" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Evaluasi</label>
                                    <input type="date" name="tglEvaluasi" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Lampiran</label>
                                    <input type="file" name="lampiran" class="form-control">
                                </div>


                                <div class="col-md-12 text-center">
                                    <a class="btn btn-secondary" href="{{ route('task.index') }}" style="height:40px;width:200px"><i class="fas fa-chevron-circle-left fa-lg" style="margin-right:20px"></i>Kembali</a>
                                    <button type="submit" class="btn btn-primary" style="height:40px;width:200px"><i class="fas fa-save fa-lg" style="margin-right:20px"></i> Simpan</button>
                                </div>
                            </form>
                        </div>
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

<script>
    document.getElementById('task_id').addEventListener('change', function() {
        const statusDropdown = document.getElementById('status_dropdown');
        const tugasId = this.options[this.selectedIndex].getAttribute('data-tugas-id');
        const internGroupInput = document.getElementById('intern_group');
        // Fetch intern group details
        fetch(`/api/kelompok/${tugasId}`)
            .then(response => response.json())
            .then(data => {
                if (data.groupName) {
                    internGroupInput.value = data.groupName;
                } else {
                    internGroupInput.value = 'Intern Group not found.';
                }
            })
            .catch(error => {
                internGroupInput.value = 'Error fetching Intern Group.';
            });

    });
</script>



@endsection