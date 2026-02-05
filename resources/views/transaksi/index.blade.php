@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaksi') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                 <div class="card shadow">
                    <div class="card-body">
                        
                    <div class="mb-4">
                        <h3>Daftar Transaksi</h3>
                        <a href="{{ route('transaksis.create') }}" class="btn btn-primary">Tambah Transaksi</a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Jenis</th>
                                <th>Nominal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($all as $key => $item)
                                <tr>
                                    <td>{{ $key + 1}}</td>

                                    <td>{{ $item->user->name ?? 'User Hilang'}}</td>

                                    <td>
                                        @if ($item->type == 'topup')
                                            <span class="text-success fw-bold">Top Up</span>
                                        @else
                                            <span class="text-danger fw-bold">Bayar</span>
                                        @endif
                                    </td>

                                    <td>Rp {{ number_format($item->amount)}}</td>

                                    <td>
                                        <a href="{{ route('transaksis.edit', $item->id)}}" class="btn btn-primary mb-2">Edit</a>
                                        <form action="{{ route('transaksis.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Ingin Hapus')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Data Lagi Kosong Cuy!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
