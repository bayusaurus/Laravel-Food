@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.j') }}s"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
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
        <p class="mb-3"> <?php date_default_timezone_set('Asia/Jakarta'); ?>
            {{ date('l, jS \of F Y') }}
        </p>
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="#transaksi">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Transaksi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksis->count() }} Transaksi
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="#sukses">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Transaksi Sukses
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sukses->count() }} Transaksi
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="#aktif">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Transaksi Aktif
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $aktif->count() }} Transaksi
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-play fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="#batal">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Transaksi Dibatalkan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $batal->count() }} Transaksi
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-times fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>


    <div class="container-fluid">
        <div class="card shadow mb-4" id="transaksi">
            <div class="card-header py-3 bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Transaksi Hari Ini</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0" role="grid"
                            aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Meja</th>
                                    <th class="text-center">Faktur</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->nama }}</td>
                                        <td>{{ $transaksi->status }}</td>
                                        <td>{{ $transaksi->meja }}</td>
                                        <td>{{ $transaksi->faktur }}</td>
                                        <td class="text-center"><a href="{{ route('transaksi.detail', $transaksi->id) }}"
                                                class="btn btn-success">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4" id="sukses">
            <div class="card-header py-3 bg-success">
                <h6 class="m-0 font-weight-bold text-white">Transaksi Sukses</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0" role="grid"
                            aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Meja</th>
                                    <th class="text-center">Faktur</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sukses as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->nama }}</td>
                                        <td>{{ $transaksi->status }}</td>
                                        <td>{{ $transaksi->meja }}</td>
                                        <td>{{ $transaksi->faktur }}</td>
                                        <td class="text-center"><a href="{{ route('transaksi.detail', $transaksi->id) }}"
                                                class="btn btn-success">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4" id="aktif">
            <div class="card-header py-3 bg-info">
                <h6 class="m-0 font-weight-bold text-white">Transaksi Aktif</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0" role="grid"
                            aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Meja</th>
                                    <th class="text-center">Faktur</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aktif as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->nama }}</td>
                                        <td>{{ $transaksi->status }}</td>
                                        <td>{{ $transaksi->meja }}</td>
                                        <td>{{ $transaksi->faktur }}</td>
                                        <td class="text-center"><a href="{{ route('transaksi.detail', $transaksi->id) }}"
                                                class="btn btn-success">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4" id="batal">
            <div class="card-header py-3 bg-danger">
                <h6 class="m-0 font-weight-bold text-white">Transaksi Batal</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0" role="grid"
                            aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Meja</th>
                                    <th class="text-center">Faktur</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($batal as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->nama }}</td>
                                        <td>{{ $transaksi->status }}</td>
                                        <td>{{ $transaksi->meja }}</td>
                                        <td>{{ $transaksi->faktur }}</td>
                                        <td class="text-center"><a href="{{ route('transaksi.detail', $transaksi->id) }}"
                                                class="btn btn-success">Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection
