@extends('layouts.admin')

@section('scripts')
    <script>
        $('.show').on('click', function(e) {
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
        $('.pesan').on('click', function(e) {
            let link = $(this).attr('link');
            var transaksi = $(this).attr('transaksi');
            $.ajax({
                url: link,
                data: {
                    _token: '{{ csrf_token() }}',
                    transaksi
                },
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#render').html(response['html']);
                },
                error: function(response) {
                    alert('error');
                }
            });
        });
        $('#showCart').on('click', function(e) {
            let link = $(this).attr('link');
            var transaksi = $(this).attr('transaksi');
            $.ajax({
                url: link,
                data: {
                    _token: '{{ csrf_token() }}',
                    transaksi
                },
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#renderLG').html(response['html']);
                },
                error: function(response) {
                    alert('error');
                }
            });
        });

        $('#modalCenterLG').on('hidden.bs.modal', function() {
            var transaksi = $('#showCart').attr('transaksi');
            let link = '/transaksi/menu/cart-counter/' + transaksi;
            $.ajax({
                url: link,
                data: {
                    _token: '{{ csrf_token() }}',
                    transaksi
                },
                method: 'get',
                dataType: 'json',
                success: function(response) {
                    $('#cart-counter').html(response);
                },
                error: function(response) {
                    console.log('error');
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
                                    Meja: </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transaksi->meja->nama }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-tasks fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                <button type="button" class="btn btn-primary btn-sm" id="showCart" data-toggle="modal"
                    data-target="#modalCenterLG" transaksi="{{ $transaksi->id }}"
                    link="{{ route('transaksi.menu.cart', $transaksi) }}">
                    <i class=" fas fa-shopping-cart"></i> Cart <span class="badge badge-danger"
                        id="cart-counter">{{ $cartCounter }}</span>
                </button>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <h3 class="text-center">Main Course</h3>
                <hr>
                <div class="row">
                    @foreach ($main as $menu)

                        <div class="px-2 py-2 col-md-3 col-sm-6">
                            <div class="card">
                                <img src="{{ asset('images/menu/' . $menu->foto) }}" class="card-img-top" height="200"
                                    alt="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5>{{ $menu->nama }}</h5>
                                        <h5>Rp. {{ number_format($menu->harga, 0, '.', '.') }}</h5>
                                    </div>
                                    <div class="col text-center">
                                        <button class="btn btn-primary pesan"
                                            link="{{ route('transaksi.menu.add', $menu) }}" data-toggle="modal"
                                            data-target="#modalCenter" slug="{{ $menu->slug }}"
                                            transaksi="{{ $transaksi->id }}">Pesan</button>
                                        <button class="btn btn-success show"
                                            link="{{ route('menu.show', $menu) }}">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h3 class="text-center mt-5">Appetizer</h3>
                <hr>
                <div class="row">
                    @foreach ($appetizer as $menu)

                        <div class="px-2 py-2 col-md-3 col-sm-6">
                            <div class="card">
                                <img src="{{ asset('images/menu/' . $menu->foto) }}" class="card-img-top" height="200"
                                    alt="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5>{{ $menu->nama }}</h5>
                                        <h5>Rp. {{ number_format($menu->harga, 0, '.', '.') }}</h5>
                                    </div>
                                    <div class="col text-center">
                                        <button class="btn btn-primary pesan"
                                            link="{{ route('transaksi.menu.add', $menu) }}" data-toggle="modal"
                                            data-target="#modalCenter" slug="{{ $menu->slug }}"
                                            transaksi="{{ $transaksi->id }}">Pesan</button>
                                        <button class="btn btn-success show"
                                            link="{{ route('menu.show', $menu) }}">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h3 class="text-center mt-5">Dessert</h3>
                <hr>
                <div class="row">
                    @foreach ($dessert as $menu)

                        <div class="px-2 py-2 col-md-3 col-sm-6">
                            <div class="card">
                                <img src="{{ asset('images/menu/' . $menu->foto) }}" class="card-img-top" height="200"
                                    alt="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5>{{ $menu->nama }}</h5>
                                        <h5>Rp. {{ number_format($menu->harga, 0, '.', '.') }}</h5>
                                    </div>
                                    <div class="col text-center">
                                        <button class="btn btn-primary pesan"
                                            link="{{ route('transaksi.menu.add', $menu) }}" data-toggle="modal"
                                            data-target="#modalCenter" slug="{{ $menu->slug }}"
                                            transaksi="{{ $transaksi->id }}">Pesan</button>
                                        <button class="btn btn-success show"
                                            link="{{ route('menu.show', $menu) }}">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h3 class="text-center mt-5">Drink</h3>
                <hr>
                <div class="row">
                    @foreach ($drink as $menu)

                        <div class="px-2 py-2 col-md-3 col-sm-6">
                            <div class="card">
                                <img src="{{ asset('images/menu/' . $menu->foto) }}" class="card-img-top" height="200"
                                    alt="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5>{{ $menu->nama }}</h5>
                                        <h5>Rp. {{ number_format($menu->harga, 0, '.', '.') }}</h5>
                                    </div>
                                    <div class="col text-center">
                                        <button class="btn btn-primary pesan"
                                            link="{{ route('transaksi.menu.add', $menu) }}" data-toggle="modal"
                                            data-target="#modalCenter" slug="{{ $menu->slug }}"
                                            transaksi="{{ $transaksi->id }}">Pesan</button>
                                        <button class="btn btn-success show"
                                            link="{{ route('menu.show', $menu) }}">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <h3 class="text-center mt-5">Other</h3>
                <hr>
                <div class="row">
                    @foreach ($other as $menu)

                        <div class="px-2 py-2 col-md-3 col-sm-6">
                            <div class="card">
                                <img src="{{ asset('images/menu/' . $menu->foto) }}" class="card-img-top" height="200"
                                    alt="">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5>{{ $menu->nama }}</h5>
                                        <h5>Rp. {{ number_format($menu->harga, 0, '.', '.') }}</h5>
                                    </div>
                                    <div class="col text-center">
                                        <button class="btn btn-primary pesan"
                                            link="{{ route('transaksi.menu.add', $menu) }}" data-toggle="modal"
                                            data-target="#modalCenter" slug="{{ $menu->slug }}"
                                            transaksi="{{ $transaksi->id }}">Pesan</button>
                                        <button class="btn btn-success show"
                                            link="{{ route('menu.show', $menu) }}">Detail</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.components.footer')
@endsection

@section('modals')
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
@endsection
