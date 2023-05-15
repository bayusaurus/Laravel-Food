@foreach ($mejas as $meja)
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

                        @can('isPelayan')
                            <button type="button" class="btn btn-sm btn-success mt-1 btn-modal" data-toggle="modal"
                                data-target="#modalCenter" data-id="{{ $meja->id }}">
                                Pesan
                            </button>
                        @endcan

                        @can('isKasir')
                            <i class="fas fa-times fa-2x text-gray-300"></i>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
