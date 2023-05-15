<div class="container">
    <div class="card">
        {{-- <img src="{{ asset('images/menu/111420200944225fafa6f6e1c41.jpeg') }}"
            class="card-img-top" height="200" alt=""> --}}
        <div class="card-body">
            <div class="text-center">
                <h5>{{ $menu->nama }}</h5>
                <h5>Rp. {{ number_format($menu->harga, 0, '.', '.') }}</h5>
            </div>
            <hr>
            <div class="col text-center">
                <h5>Masukkan Kuantitas </h5>
                <form action="{{ route('transaksi.menu.store') }}" id="form-add" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="row">
                            <div class="col-sm-2"></div>

                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger btn-sm minus"><i class="fa fa-minus"></i></button>
                                    </div>
                                    <input type="number" name="kuantitas" id="kuantitas"
                                        class="form-control form-control-sm" value="1" min="1"
                                        harga="{{ $menu->harga }}">
                                    <input type="hidden" name="transaksi" value="{{ $transaksi }}">
                                    <input type="hidden" name="menu" value="{{ $menu->id }}">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary btn-sm plus"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                    <hr>
                    <h5>Subtotal = Rp. <span id="subtotal">{{ number_format($menu->harga, 0, '.', '.') }}</span></h5>
                    <button type="submit" class="btn btn-primary pesan" data-toggle="modal"
                        data-target="#modalCenter">Pesan</button>
                    <a class="btn btn-danger" id="btn-batal">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.minus').click(function() {
            // var $input = $(this).parent().find('input');
            var $input = $('#kuantitas');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });

        $('.plus').click(function() {
            // var $input = $(this).parent().find('input');
            var $input = $('#kuantitas');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });

        $("#kuantitas").on('change keyup', function() {
            var kuantitas = $(this).val();
            var harga = $(this).attr('harga');
            $("#subtotal").text(new Intl.NumberFormat('id').format(kuantitas * harga));
        });

        $("#form-add").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $("#form-add").attr('action'),
                data: $("#form-add").serialize(),
                method: $("#form-add").attr('method'),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        $('#cart-counter').html(response.cartCounter);
                        Swal.fire(
                            'Sukses!',
                            response.message,
                            'success'
                        );
                    } else if (response.status == 0) {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function(response) {
                    alert('system error');
                }
            });
        });
    });
    
    $('#btn-batal').on('click', function() {
        $('#modalCenter').modal('hide');
    })

</script>
