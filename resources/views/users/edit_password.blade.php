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
                        <form action="{{ route('user.password.update') }}" method="post" id="change-password">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="old" class="col-form-label">Password Lama:</label>
                                <input type="password" name="old" class="form-control" id="old">
                                @error('old')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password Baru:</label>
                                <input type="password" name="new" class="form-control" id="password">
                                @error('new')
                                    <div class="text-danger mb-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="confirm-password" class="col-form-label">Ulangi Password Baru:</label>
                                <input type="password" class="form-control" id="confirm-password">
                            </div>
                            <div id='message' class="mb-2"></div>
                            <button type="submit" class="btn btn-primary" id="form-submit" disabled>Update</button>
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

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#password, #confirm-password').on('keyup', function() {
                if ($('#password').val() == $('#confirm-password').val()) {
                    $('#message').html('');
                    $('#form-submit').removeAttr('disabled');
                } else {
                    $('#message').html('Password tidak sama').css('color', 'red');
                    $('#form-submit').attr('disabled', 'true');
                }
            });

        });

    </script>
@endsection
