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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li> 
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <div class="card shadow">
                        <div class="card-body">
                            <h3>Tambah Transaksi</h3>

                            <form action="{{ route('transaksis.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Pilih Siswa</label>
                                    <select name="user_id" class="form-control" required>
                                        <option value=""> Pilih Siswa </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }} (Saldo: {{ $user->balance }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jenis Transaksi</label>
                                    <select name="type" class="form-control">
                                        <option value="topup">Topup (Tambah Saldo)</option>
                                        <option value="pay">Bayar (Kurang Saldo)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nominal (RP)</label>
                                    <input type="number" name="amount" class="form-control" placeholder="0" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" name="description" class="form-control" placeholder="Masukkan Deskripsi">

                                    <div class="button mt-2">
                                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                                    <a href="{{ route('transaksis.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
