@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">User Id</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Jumlah Saldo</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transactions as $t)
                                     <tr>
                                    <td scope="row">{{ $t->user_id }}</td>
                                    <td>{{ $t->user->name }}</td>
                                    <td><span class="text-success fw-bold">{{ $t->type }}</span></td>
                                    <td>{{ number_format($t->amount) }}</td>
                                    <td>{{ $t->description }}</td>
                                     </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">Data Lagi Kosong Bro!</td>
                                    </tr>   
                                @endforelse
                            </tbody>
                        </table>
                        <a href="{{ route('transaksis.index') }}" class="btn btn-warning text-white btn-sm">Lihat Transaksi -></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
