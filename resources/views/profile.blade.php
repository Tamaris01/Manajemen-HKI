@extends('layouts.app')
@section('content')
<style>
 
    .btn-primary {
        background: linear-gradient(to right,#b3d9ff, #17a2b8, #007bff);
    }
	.card{
	  background-color: #ffffff;
	  box-shadow: 0px 1px 3px 3px rgba(0, 123, 255, 0.5);
	}
</style>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('profile/'.Auth::user()->image) }}" alt="Profile Image" class="rounded-circle mb-3"
                            style="width: 150px;">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->username }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Profile</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profil-update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    value="{{ Auth::user()->username }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password (isi jika ingin mengganti)</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image (isi jika ingin mengganti)</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="mt-3">
                                <input type="submit" class="btn btn-primary w-100" value="Simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
