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
            $('#tanggal').hide();

            $('#filter').on('click', function() {
                $('#tanggal').toggle();
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
        <div class="text-center mt-2 mb-4 text-decoration-none">
            <h3 class="d-inline">{{ $title }}</h3>
            <button class="btn btn-sm btn-primary d-inline float-right mx-1" id="filter">Filter</button>
            @if (!empty($start_date) and !empty($end_date))
                <form action="{{ route('transaksi.laporan.print') }}" method="post" target="_blank"
                    class=" d-inline float-right mx-1">
                    @csrf
                    <input type="hidden" name="start" value="{{ $start_date }}">
                    <input type="hidden" name="end" value="{{ $end_date }}">
                    <button type="submit" class="btn btn-sm btn-info">Print</button>
                </form>
            @else
                <form action="{{ route('transaksi.laporan.print') }}" method="post" target="_blank"
                    class=" d-inline float-right mx-1">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-info">Print</button>
                </form>
            @endif
        </div>
        <div class="container" id="tanggal">
            <form action="{{ route('transaksi.laporan.table') }}" method="get" id="form-filter">
                <div class="row d-flex justify-content-end mb-3">
                    <div class="form-group-row mr-3">
                        <label>Tanggal awal</label>
                        <input type="date" name="start_date" id="start-date" max="3000-12-31" min="2020-01-01"
                            class="form-control" required>
                    </div>
                    <div class="form-group-row">
                        <label>Tanggal akhir</label>
                        <input type="date" name="end_date" id="end-date" min="2020-01-01" max="3000-12-31"
                            class="form-control" required>
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3"><button type="submit" id="submit-filter"
                        class="btn btn-primary">Terapkan</button>
                </div>
            </form>
        </div>

        <div class="row">
            <!-- Earnings (Monthly) Card Example -->

            <div class="col-xl-3 col-md-6 mb-4">
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
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Pemasukan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                    {{ number_format($omset->total, 0, '.', '.') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-play fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Transaksi Sukses
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sukses }} Transaksi
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Transaksi Dibatalkan
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $batal }} Transaksi
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4" id="transaksi">
            <div class="card-body">
                <div class="row">

                </div>
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
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $transaksi)
                                    @if ($transaksi->status == 'SUKSES')
                                        @php
                                        $bg = '';
                                        @endphp
                                    @endif
                                    @if ($transaksi->status == 'BATAL')
                                        @php
                                        $bg = 'table-danger';
                                        @endphp
                                    @endif
                                    @if ($transaksi->status == 'AKTIF')
                                        @php
                                        $bg = 'table-info';
                                        @endphp
                                    @endif
                                    <tr class="{{ $bg }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaksi->nama }}</td>
                                        <td>{{ $transaksi->status }}</td>
                                        <td>{{ $transaksi->meja }}</td>
                                        <td>{{ $transaksi->faktur }}</td>
                                        <td>Rp.
                                            {{ $transaksi->total_bayar == null ? '0' : number_format($transaksi->total_bayar, 0, '.', '.') }}
                                        </td>
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
