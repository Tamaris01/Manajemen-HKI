@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Daftar Data Admin</h4>
                        <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#tambah">
                            Tambah
                        </button>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Nama Lengkap</th>
                                    <th class="text-center">username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $value->id }}</td>
                                        <td class="text-center">{{ $value->name }}</td>
                                        <td class="text-center">{{ $value->username }}</td>
                                        <td class="text-center">{{ $value->email }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#update-{{ $value->id }}">
                                                Update
                                            </button>
                                            <a href="{{ route('admin-delete', $value->id) }}"
                                                class="btn btn-danger alrt">Hapus</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah admin</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin-tambah') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Id </label>
                            <input type="number" class="form-control" required name="id">
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama </label>
                            <input type="text" class="form-control" required name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Username </label>
                            <input type="text" class="form-control" required name="username">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email </label>
                            <input type="email" class="form-control" required name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password </label>
                            <input type="text" class="form-control" required name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($admin as $key => $value)
    <div class="modal fade" id="update-{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah admin</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('admin-update') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Nama </label>
                            <input type="hidden" name="id" value="{{ $value->id }}">
                            <input type="text" class="form-control" required value="{{ $value->name }}" name="name">
                        </div>
                        <div class="form-group mb-3">
                            <label>Username </label>
                            <input type="text" class="form-control" required value="{{ $value->username }}" name="username">
                        </div>
                        <div class="form-group mb-3">
                            <label>Email </label>
                            <input type="email" class="form-control" required value="{{ $value->email }}" name="email">
                        </div>
                        <div class="form-group mb-3">
                            <label>Password (isi ketika ingin mengganti)</label>
                            <input type="text" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
@section('script')
@endsection
