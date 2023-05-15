@foreach ($transaksis as $transaksi)
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger border-bottom-danger border-danger shadow h-100">
            <div class="card-body">
                <div class="align-items-center">
                    <div class="mb-2 text-center">
                        <div class=" font-weight-bold text-danger text-uppercase mb-1">
                            {{ $transaksi->meja->nama }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksi->nama }}</div>
                    </div>
                    <div class="container d-flex justify-content-center">
                        @can('isPelayan')
                            <a href="{{ route('transaksi.menu.create', $transaksi) }}"
                                class="btn btn-sm btn-success mt-1">Detail</a>
                        @endcan

                        @can('isKasir', Model::class)
                            <a href="{{ route('transaksi.detail', $transaksi) }}"
                                class="btn btn-sm btn-success mx-1">Detail</a>
                        @endcan

                        @can('isAdmin', Model::class)
                            <a href="{{ route('transaksi.detail', $transaksi) }}"
                                class="btn btn-sm btn-success mx-1">Detail</a>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
