@extends('layouts.app')

@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    <!-- ... Isi konten sidebar Anda ... -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            @include('layouts.nav')
            <div class="container">
                <h1>Task Details</h1>

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $task->judul }}</h5>
                        <p class="card-text">{{ $task->deskripsi }}</p>
                        <p class="card-text">Status: {{ $task->status }}</p>
                        <p class="card-text">Tanggal Mulai: {{ $task->tglMulai }}</p>
                        <p class="card-text">Tanggal Selesai: {{ $task->tglSelesai }}</p>
                    </div>
                </div>

                <a href="{{ route('task.index') }}" class="btn btn-secondary mt-3">Back to List</a>
            </div>
        </div>
        <!-- End of Main Content -->
    </div>
    <!-- End of Content Wrapper -->
</div>
@endsection
