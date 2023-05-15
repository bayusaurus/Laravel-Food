@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.j') }}s"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('.btn-deactivate').on('click', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            console.log(form);
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
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                                role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                {{-- <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Position</th>
                                        <th rowspan="1" colspan="1">Office</th>
                                        <th rowspan="1" colspan="1">Age</th>
                                        <th rowspan="1" colspan="1">Start date</th>
                                        <th rowspan="1" colspan="1">Salary</th>
                                    </tr>
                                </tfoot> --}}
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->role->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center ">
                                                <div class="row justify-content-center">
                                                    <a class="btn btn-success btn-sm btn-circle mx-1"
                                                        href="{{ route('user.profile', $user->unique_id) }}">
                                                        <span data-toggle="tooltip" title="Detail">
                                                            <i class="fas fa-info-circle"></i>
                                                        </span>
                                                    </a>

                                                    @can('isOwner')
                                                        @if ($user->role_id !== 1)
                                                            <form action="{{ route('user.deactivate') }}"
                                                                class="mx-1 form-deactivate" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-circle btn-sm btn-deactivate"
                                                                    nama="{{ $user->nama }}">
                                                                    <span data-toggle="tooltip" title="Nonaktifkan">
                                                                        <i class="fas fa-trash"></i>
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan

                                                    @can('isAdmin')
                                                        @if ($user->role_id !== 1 and $user->role_id !== 2)
                                                            <form action="{{ route('user.deactivate') }}"
                                                                class="mx-1 form-deactivate" method="post">
                                                                @csrf
                                                                @method('put')
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-circle btn-sm btn-deactivate"
                                                                    nama="{{ $user->nama }}">
                                                                    <span data-toggle="tooltip" title="Nonaktifkan">
                                                                        <i class="fas fa-trash"></i>
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @endcan

                                                </div>
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
    </div>


@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection
