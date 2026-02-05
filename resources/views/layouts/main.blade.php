<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persiapan LKS</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .sidebar {
            min-height: 80vh;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-3">
        <a href="" class="navbar-brand">LKS Jatim 2026</a>
        <form action="">
            @csrf
            <button class="btn btn-sm btn-danger">Logout</button>
        </form>
    </nav>

    <div class="container-fluid">
        <div class="row">

        <div class="col-md-2 bg-light sidebar p-3 border-end">
            <div class="d-grid gap-2">
                <h6 class="text-muted">Menu Utama</h6>
                <a href="" class="btn btn-primary text-start">Dashboard</a>
                <a href="" class="btn btn-outline-secondary text-start border-0">Data Siswa</a>
                <a href="" class="btn btn-outline-secondary text-start border-0">Transaksi</a>
                <a href="" class="btn btn-outline-secondary text-start border-0">Laporan</a>
            </div>

            <div class="col-md-10 p-4 bg-white">
                @yield('content')
            </div>
        </div>
        </div>
    </div>
</body>
</html>