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

@section('scripts')
    <script>
        $('.btn-deactivate').on('click', function(e) {
            e.preventDefault();
            var form = $(this).parent();
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah anda yakin ingin menonaktifkan " + $(this).attr('nama') + " ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
        $('.btn-activate').on('click', function(e) {
            e.preventDefault();
            var form = $(this).parent();
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah anda yakin ingin mengaktifkan " + $(this).attr('nama') + " ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
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

    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <div class="photo-profile">
                                    <img src="{{ asset('images/user/' . $user->foto) }}" alt="Admin" class="rounded-circle">
                                </div>
                                @if ($user->id == Auth::user()->id)
                                    <div class="mt-3">
                                        <a href="{{ route('user.avatar.edit') }}" class="btn btn-outline-primary">Ganti
                                            Foto</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    @if ($user->id == Auth::user()->id)
                        <div class="text-right mb-3">
                            <a href="{{ route('user.info.edit') }}" class="btn btn-primary">Edit Info</a>
                            <a href="{{ route('user.password.edit') }}" class="btn btn-primary">Ganti Password</a>
                        </div>
                    @endif

                    @can('isOwner')
                        @if ($user->role_id !== 1)
                            @if ($user->deactivated_at == null)
                                <div class="text-right mb-3">
                                    <form action="{{ route('user.deactivate') }}" class="mx-1 form-deactivate" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-danger btn-deactivate" nama="{{ $user->nama }}">
                                            <span data-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i> Deactivate User
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if ($user->deactivated_at !== null)
                                <div class="text-right mb-3">
                                    <form action="{{ route('user.activate') }}" class="mx-1 form-activate" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-primary btn-activate"
                                            nama="{{ $user->nama }}">
                                            <span data-toggle="tooltip" title="Aktifkan">
                                                <i class="fas fa-recycle"></i> Activate User
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    @endcan

                    @can('isAdmin')
                        @if ($user->role_id !== 1 and $user->role_id !== 2)
                            @if ($user->deactivated_at == null)
                                <div class="text-right mb-3">
                                    <form action="{{ route('user.deactivate') }}" class="mx-1 form-deactivate" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-danger btn-deactivate" nama="{{ $user->nama }}">
                                            <span data-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash"></i> Deactivate User
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if ($user->deactivated_at !== null)
                                <div class="text-right mb-3">
                                    <form action="{{ route('user.activate') }}" class="mx-1 form-activate" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-primary btn-activate"
                                            nama="{{ $user->nama }}">
                                            <span data-toggle="tooltip" title="Aktifkan">
                                                <i class="fas fa-recycle"></i> Activate User
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    @endcan

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->nama }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Role</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->role->nama }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->detail->telepon }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ $user->detail->alamat }}
                                </div>
                            </div>
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
