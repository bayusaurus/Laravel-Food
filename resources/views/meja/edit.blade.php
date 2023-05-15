@extends('layouts.admin')

@section('scripts')
    <script>
        $('.custom-file input').change(function(e) {
            if (e.target.files.length) {
                $(this).next('.custom-file-label').html(e.target.files[0].name);
            }
        });

    </script>
@endsection

@section('sidebar')
    @include('layouts.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.components.navbar')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">

                    <form class="user py-3 col-md-8 col-sm-8" method="post" action="{{ route('meja.edit', $meja) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Edit Meja : {{ $meja->nama }}</h1>
                        </div>

                        <div class="mb-3">
                            <div class="custom-file">
                                <input type="file" name="foto" id="foto"
                                    class="custom-file-input @error('foto') is-invalid @enderror">
                                <label class="custom-file-label" for="foto">Choose
                                    file...</label>
                                @error('foto')
                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="input-group @error('nama') is-invalid @enderror">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="nama">Nama</span>
                                </div>
                                <input type="text" name="nama" value="{{ old('nama') ?? $meja->nama }}" id="nama"
                                    class="form-control @error('nama') is-invalid @enderror">
                            </div>
                            @error('nama')
                                <div class="invalid-feedback mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="input-group @error('kapasitas') is-invalid @enderror">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="kapasitas">Kapasitas</span>
                                </div>
                                <input type="number" name="kapasitas" value="{{ old('harga') ?? $meja->kapasitas }}" id="kapasitas"
                                    class="form-control @error('kapasitas') is-invalid @enderror">
                            </div>
                            @error('kapasitas')
                                <div class="invalid-feedback mb-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4"><button type="submit" class="btn btn-primary form-control">Edit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection
