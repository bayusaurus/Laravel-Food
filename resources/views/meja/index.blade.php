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
        $('.showMeja').on('click', function(e) {
            let link = $(this).attr('link');
            $.ajax({
                url: link,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    // $('#asyncModal').html(response['html']);
                    Swal.fire({
                        title: response.nama,
                        text: 'Kapasitas : ' + response.kapasitas + ' | ' + 'Session Code : ' +
                            response.sessionCode,
                        imageUrl: response.foto,
                        imageWidth: 400,
                        imageHeight: 200,
                        imageAlt: 'Custom image',
                    })
                },
                error: function(response) {
                    alert('error');
                }
            });
        });
        $('.deleteMeja').on('click', function(e) {
            var nama = $(this).attr('nama');
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah anda yakin ingin menghapus " + nama + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let link = $(this).attr('link');
                    var row = $(this).parent().parent();
                    $.ajax({
                        url: link,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        method: 'delete',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 'gagal') {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error'
                                );
                            } else {
                                Swal.fire(
                                    'Sukses!',
                                    response.message,
                                    'success'
                                );
                                row.remove();
                            }

                        },
                        error: function(response) {
                            alert('error');
                        }
                    });
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
        <a href="{{ route('menu.create') }}" class="btn btn-primary btn-icon-split mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-flag"></i>
            </span>
            <span class="text">Add New Menu</span>
        </a>
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
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Kapasitas</th>
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
                                    @foreach ($mejas as $meja)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $meja->nama }}</td>
                                            <td>{{ $meja->statusMeja->nama }}</td>
                                            <td>{{ $meja->kapasitas }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm btn-circle showMeja"
                                                    link="{{ route('meja.show', $meja) }}">
                                                    <span data-toggle="tooltip" title="Detail">
                                                        <i class="fas fa-info-circle"></i>
                                                    </span>
                                                </button>

                                                <a href="{{ route('meja.edit', $meja) }}"
                                                    class="btn btn-info btn-sm btn-circle" data-toggle="tooltip"
                                                    title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <button type="button" class="btn btn-danger btn-circle btn-sm deleteMeja"
                                                    link="{{ route('meja.delete', $meja) }}" nama="{{ $meja->nama }}">
                                                    <span data-toggle="tooltip" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                </button>
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
