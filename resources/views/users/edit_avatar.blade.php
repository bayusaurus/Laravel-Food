@extends('layouts.admin')

@section('styles')
    <style>
        .photo-profile {
            height: 250px;
            width: 250px;
        }

        .photo-profile img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            background-position: center center;
        }

    </style>
@endsection

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
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 mb-2  d-flex justify-content-center" id="preview">
                            <div class="photo-profile mb-2" id="preview">
                                <img src="{{ asset('images/user/' . Auth::user()->foto) }}" id="preview-img" class="rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6">
                            <form action="{{ route('user.avatar.update') }}" method="post" enctype="multipart/form-data"
                                id="change-password">
                                @csrf
                                @method('put')
                                <div class="mb-3">
                                    <div class="custom-file">
                                        <input type="file" name="foto" id="foto"
                                            class="custom-file-input @error('foto') is-invalid @enderror" required>
                                        <label class="custom-file-label" for="foto">Choose
                                            file...</label>
                                        @error('foto')
                                            <div class="invalid-feedback mb-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" id="form-submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection

@section('scripts')
    <script>
        $('.custom-file input').change(function(e) {
            if (e.target.files.length) {
                $(this).next('.custom-file-label').html(e.target.files[0].name);
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#preview-img').show();
                    $('#preview-img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#foto").change(function() {
            readURL(this);
        });

    </script>
@endsection
