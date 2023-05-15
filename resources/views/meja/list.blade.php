@extends('layouts.admin')

@section('scripts')
    <script>
        $('.btn-modal').on('click', function() {
            var id = $(this).attr('data-id');
            $("#form-modal #id-meja").val(id);
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
                <div class="row">

                    @isset($all)
                        @include('meja.show.all')
                    @endisset

                    @isset($free)
                        @include('meja.show.free')
                    @endisset

                    @isset($aktif)
                        @include('meja.show.active')
                    @endisset


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
                    <h5>Masukkan Nama Pelanggan</h5>
                    <form action="{{ route('transaksi.create') }}" method="post" id="form-modal">
                        @csrf
                        <div class="container">
                            <input type="text" name="nama" class="form-control mt-3 mb-3" placeholder="Nama" required>
                            <input type="hidden" name="meja" value="" id="id-meja">
                        </div>
                        <div class="col text-center">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
