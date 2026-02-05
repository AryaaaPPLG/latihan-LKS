@extends('layouts.main')

@section('content')
<div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard Admin</h1>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5>Total Saldo</h5>
                    <h2>{{ number_format(Auth::user()->balance ?? 0 )}}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h2>150</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">Riwayat Terbaru</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Budi</td>
                        <td>Top Up</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection