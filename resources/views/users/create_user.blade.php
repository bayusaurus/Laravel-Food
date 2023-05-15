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
                    <li class="breadcrumb-item active" aria-current="page">Create New User</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
            <form action="{{ route('user.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <div class="photo-profile mb-2" id="preview">
                                        <img src="" id="preview-img" class="rounded-circle">
                                    </div>

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

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">

                                <div class="row d-flex h-100">
                                    <div class="col-sm-3 align-self-center">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="nama"
                                            class="form-control  @error('nama') is-invalid @enderror" id="nama"
                                            value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>

                                <div class="row d-flex h-100">
                                    <div class="col-sm-3 align-self-center">
                                        <h6 class="mb-0">Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="password"
                                            class="form-control  @error('password') is-invalid @enderror" id="password"
                                            required>
                                        @error('password')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <hr>

                                <div class="row d-flex h-100">
                                    <div class="col-sm-3 align-self-center">
                                        <h6 class="mb-0">Confirm Password</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                            id="confirm-password" required>
                                        <div class="text-danger mb-2" id="confirm-password-message"></div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row d-flex h-100">
                                    <div class="col-sm-3 align-self-center">
                                        <h6 class="mb-0">Role</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="role" class="custom-select @error('role') is-invalid @enderror"
                                            id="role" required>
                                            <option disabled {{ empty(old('role')) ? 'selected' : '' }}>Choose...</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    {{ old('role') == $role->id ? 'selected' : '' }}>
                                                    {{ $role->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>

                                <div class="row d-flex h-100">
                                    <div class="col-sm-3 align-self-center">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" name="email"
                                            class="form-control  @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="text-danger mb-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @error('role')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>

                                <div class="row d-flex h-100">
                                    <div class="col-sm-3 align-self-center">
                                        <h6 class="mb-0">Telepon</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="telepon"
                                            class="form-control  @error('telepon') is-invalid @enderror" id="telepon"
                                            value="{{ old('telepon') }}" required>
                                    </div>
                                    @error('telepon')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>

                                <div class="row d-flex h-100">
                                    <div class="col-sm-3 align-self-center">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="alamat"
                                            class="form-control  @error('alamat') is-invalid @enderror" id="alamat"
                                            value="{{ old('alamat') }}" required>
                                    </div>
                                    @error('alamat')
                                        <div class="text-danger mb-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>

                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary " id="form-submit" disabled>Create</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection

@section('scripts')
    <script>
        $('#preview-img').hide();
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

        $(document).ready(function() {

            $('#password, #confirm-password').on('keyup', function() {
                if ($('#password').val() == $('#confirm-password').val()) {
                    $('#confirm-password-message').html('');
                    $('#form-submit').removeAttr('disabled');
                } else {
                    $('#confirm-password-message').html('Password tidak sama').css('color', 'red');
                    $('#form-submit').attr('disabled', 'true');
                }
            });

        });

    </script>
@endsection
