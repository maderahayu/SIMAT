<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMAT Cetak Logbook</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>

<div class="col-md-12 text-center pb-3 row">
    <div class="col-md-4 pt-2 offset-md-2">
        <img src="{{ asset('img/logo.png') }}" width="50%" height="60%" alt="logo">
    </div>
    <div class="col-md-6">
        <h3 style="padding-top:10%">Logbook</h3>
    </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="table" width="100%" cellspacing="0">
            <thead>
                <tr class="table-secondary">
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center" style="width:30%">Tugas</th>
                    <th scope="col" class="text-center" style="width:50%">Deskripsi</th>
                    <th scope="col" class="text-center">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logbook as $log)
                <tr>
                    <th scope="row" class="text-center">{{ $loop->iteration}}</th>
                    <td>{{ $log->task->judul }}</td>
                    <td>{{ $log->deskripsi }}</td>
                    <td class="text-center">{{$log->tglLogbook}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>