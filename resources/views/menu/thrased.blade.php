@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.j') }}s"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('.showMenu').on('click', function(e) {
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
                        title: response.nama + "<br>Rp.  " + response.harga,
                        text: response.keterangan,
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
        $('.restoreMenu').on('click', function(e) {
            var nama = $(this).attr('nama');
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah anda yakin ingin merestore " + nama + " ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let link = $(this).attr('link');
                    var row = $(this).parent().parent();
                    $.ajax({
                        url: link,
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        method: 'put',
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire(
                                'Sukses!',
                                response,
                                'success'
                            );
                            row.remove();
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
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Harga</th>
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
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $menu->nama }}</td>
                                            <td>{{ $menu->jenisMenu->nama }}</td>
                                            <td>{{ $menu->harga }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-success btn-sm btn-circle showMenu"
                                                    link="{{ route('menu.thrased.show', $menu->id) }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm btn-circle restoreMenu"
                                                    link="{{ route('menu.restore', $menu->id) }}" nama="{{ $menu->nama }}">
                                                    <i class="fas fa-recycle"></i>
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
