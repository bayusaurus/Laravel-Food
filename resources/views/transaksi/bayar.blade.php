@extends('layouts.admin')

@section('scripts')
    <script>
        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }
        $('#bayar').on('change keyup', delay(function() {
            var bayar = $(this).val();
            var total = parseInt($(this).attr('total'));
            if (bayar >= total) {
                $('#kembalian').val('Rp ' + new Intl.NumberFormat('id').format(bayar - total));
                $('#submitBayar').removeAttr('disabled');
            } else {
                alert('Uang pembayaran kurang');
                $('#kembalian').val(0);
                $('#submitBayar').attr('disabled', 'true');
            }
        }, 500));
        $('#batalkan').on('click', function(e) {
            e.preventDefault();
            var form = $(this).parents('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "Apakah anda yakin ingin membatalkan Transaksi ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel it!'
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
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                @can('isKasir')
                    @if ($transaksi->status_transaksi_id !== 1)
                        <a href="{{ route('transaksi.invoice', $transaksi) }}" target="_blank" class="btn btn-info">Print</a>
                    @endif
                    @if ($transaksi->status_transaksi_id == 1)
                        <form action="{{ route('transaksi.batal', $transaksi) }}" method="post">
                            @csrf @method('put')
                            <button type="submit" class="btn btn-danger" id="batalkan">Batalkan Transaksi</button>
                        </form>
                    @endif
                @endcan
                @can('isAdmin')
                    @if ($transaksi->status_transaksi_id !== 1)
                        <form action="{{ route('transaksi.invoice', $transaksi) }}" method="get" target="_blank">
                            @csrf
                            <button class="btn btn-info" id="print">Print</button>
                        </form>
                    @endif
                @endcan
                @can('isOwner')
                    @if ($transaksi->status_transaksi_id !== 1)
                        <form action="{{ route('transaksi.invoice', $transaksi) }}" method="get" target="_blank">
                            @csrf
                            <button class="btn btn-info" id="print">Print</button>
                        </form>
                    @endif
                @endcan
            </div>
            <div class="card-body">
                <div class="row d-flex justify-content-center">

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-1">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Nomor Faktur: </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksi->faktur }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-1">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Nama Pelanggan: </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksi->nama }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-1">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Meja : </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksi->meja->nama }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-1">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Status : </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $transaksi->statusTransaksi->nama }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tasks fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Menu</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">Kuantitas</th>
                                    <th class="text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menus as $menu)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $menu->nama }}</td>
                                        <td class="text-center">Rp. {{ number_format($menu->harga, 0, '.', '.') }}</td>
                                        <td class="text-center">{{ $menu->kuantitas }}</td>
                                        <td class="text-center">Rp. {{ number_format($menu->subtotal, 0, '.', '.') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right"><strong>TOTAL</strong></td>
                                    <td class="text-center"><strong>{{ $total->kuantitas }}</strong></td>
                                    <td class="text-center"><strong>Rp.
                                            {{ number_format($total->subtotal, 0, '.', '.') }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @can('isKasir')
                        @if ($transaksi->status_transaksi_id == 1)
                            <div class="ml-auto">
                                <form class="form-inline" action="{{ route('transaksi.bayar', $transaksi) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="bayar">Bayar: </label>
                                        <input type="number" class="form-control" name="bayar" id="bayar"
                                            total="{{ $total->subtotal }}" placeholder="Nominal Bayar">
                                    </div>
                                    <div class="form-group mx-sm-3 mb-2">
                                        <label for="kembalian">Kembalian: </label>
                                        <input type="text" class="form-control" id="kembalian" placeholder="Kembalian" disabled>
                                    </div>
                                    <input type="hidden" name="total" value="{{ $total->subtotal }}">
                                    <button type="submit" id="submitBayar" class="btn btn-primary mb-2" disabled>Bayar</button>
                                </form>
                            </div>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection

{{-- @section('modals')
<div class="modal fade" id="modalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content py-3">
            <div class="modal-body text-center">
                <div id="render"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCenterLG" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content py-3">
            <div class="modal-body text-center">
                <div id="renderLG"></div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
