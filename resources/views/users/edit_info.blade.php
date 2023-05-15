@extends('layouts.admin')


@section('sidebar')
    @include('layouts.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')

    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body d-flex justify-content-center">
                    <div class="col-md-6">
                        <form action="{{ route('user.info.update') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Nama:</label>
                                <input type="text" name="nama" class="form-control  @error('nama') is-invalid @enderror"
                                    id="nama" value="{{ old('nama') ?? $user->nama }}">
                                @error('nama')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="telepon" class="col-form-label">Telepon:</label>
                                <input type="text" name="telepon"
                                    class="form-control  @error('telepon') is-invalid @enderror" id="telepon"
                                    value="{{ old('telepon') ?? $user->detail->telepon }}">
                                @error('telepon')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat:</label>
                                <input type="text" name="alamat" class="form-control  @error('alamat') is-invalid @enderror"
                                    id="alamat" value="{{ old('alamat') ?? $user->detail->alamat }}">
                                @error('alamat')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary" id="form-submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection
