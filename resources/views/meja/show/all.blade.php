@foreach ($mejas as $meja)
    @if ($meja->statusMeja->nama == 'KOSONG')
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success border-bottom-success border-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class=" font-weight-bold text-success text-uppercase mb-1">
                                {{ $meja->nama }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Kosong</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($meja->statusMeja->nama == 'AKTIF')
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger border-bottom-danger border-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class=" font-weight-bold text-danger text-uppercase mb-1">
                                {{ $meja->nama }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Aktif</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
