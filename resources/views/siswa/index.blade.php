@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Siswa') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <div class="card shadow">
                    <div class="card-body">
                      <h3>Data User</h3>
                      <a href="{{ route('siswas.create') }}" class="btn btn-primary mb-3">Tambah User</a>

                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse ($users as $key => $user)
                            <tr>
                              <td>{{ $key + 1}}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>Rp {{ number_format($user->balance) }}</td>
                              <td>
                                <form action="{{ route('siswas.destroy',$user->id) }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Ingin Hapus Data Ini?')">Hapus</button>
                                </form>
                              </td>
                            </tr>

                            @empty
                            <tr>
                              <td colspan="5" class="text-center text-muted">Data User Kosong Bos!</td>
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
