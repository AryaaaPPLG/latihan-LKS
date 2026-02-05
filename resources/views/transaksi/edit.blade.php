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

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label fw-bold">Siswa</label>
                            <input type="text" class="form-control bg-light" 
                                   value="{{ $transaksi->user->name ?? 'User Terhapus' }}" 
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Transaksi</label>
                            <input type="text" class="form-control bg-light" 
                                   value="{{ $transaksi->type == 'topup' ? 'Top Up (Masuk)' : 'Pembayaran (Keluar)' }}" 
                                   readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nominal</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control bg-light" 
                                       value="{{ number_format($transaksi->amount, 0, ',', '.') }}" 
                                       readonly>
                            </div>
                            <small class="text-danger">*Nominal dan User tidak dapat diedit demi keamanan saldo.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Keterangan</label>
                            <input type="text" name="description" class="form-control" 
                                   value="{{ old('description', $transaksi->description) }}" 
                                   placeholder="Masukkan deskripsi">
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('transaksis.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update Data</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
