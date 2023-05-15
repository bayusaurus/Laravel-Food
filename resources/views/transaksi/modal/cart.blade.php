<div class="container">


    <div class="modal-header mb-3">
        <h5 class="modal-title" id="exampleModalLabel">Cart Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @foreach ($menuTransaksi as $item)
        <div class="card mb-3">
            <div class="row d-flex h-100">

                <div class=" col-md-3">
                    <img src="{{ asset('images/menu/' . $item->foto) }}" class="card-img" alt="..." height="200">
                </div>

                <div class="col-md-3 " style="margin-top: auto; margin-bottom: auto;">
                    <div class="my-2">
                        <h5 class="card-title">{{ $item->nama }}</h5>
                        <h5>Rp. {{ number_format($item->harga, 0, '.', '.') }}</h5>
                    </div>
                </div>

                <div class="col-md-2" style="margin-top: auto; margin-bottom: auto;">
                    <div class="input-group my-2 container">
                        <div class="input-group-prepend">
                            <button class="btn btn-danger btn-sm minus"><i class="fa fa-minus"></i></button>
                        </div>
                        <input type="number" name="kuantitas" class="form-control form-control-sm kuantitas"
                            value="{{ $item->kuantitas }}" harga="{{ $item->harga }}" subtotal="{{ $item->subtotal }}"
                            min="1">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary btn-sm plus"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="col-md-2" style="margin-top: auto; margin-bottom: auto;">
                    <div class="my-2">
                        <h5 class="card-title">Rp.
                            <span class="subtotal">{{ number_format($item->subtotal, 0, '.', '.') }}</span>
                        </h5>
                    </div>
                </div>

                <div class="col-md-2" style="margin-top: auto; margin-bottom: auto;">

                    <div class="my-1">
                        <button class="btn btn-primary cartUpdate"
                            link="{{ route('transaksi.menu.update', [$transaksi, $item->menu_id]) }}"
                            menu="{{ $item->menu_id }}" transaksi="{{ $transaksi->id }}" harga="{{ $item->harga }}"
                            disabled>Update</button>
                    </div>
                    <div class="my-2">
                        <button class="btn btn-danger cartDelete"
                            link="{{ route('transaksi.menu.delete', [$transaksi, $item->menu_id]) }}"
                            menu="{{ $item->menu_id }}" transaksi="{{ $transaksi->id }}"
                            nama="{{ $item->nama }}">Delete</button>
                    </div>

                </div>

            </div>
        </div>
    @endforeach
    <hr>
    <div class="row mt-4">

        <div class=" col-md-3">
        </div>
        <div class="col-md-3 ">
            <h5>TOTAL</h5>
        </div>

        <div class="col-md-2">
            <h5><span id="totalKuantitas">{{ $total->kuantitas }}</span></h5>
        </div>

        <div class="col-md-2">
            <h5>Rp. <span id="totalHarga">{{ number_format($total->subtotal, 0, '.', '.') }}</span></h5>
        </div>

        <div class="col-md-2">
        </div>

    </div>
    <hr>




</div>

<script>
    $('.minus').click(function() {
        var kuantitas = $(this).parent().parent().find('.kuantitas');
        var harga = kuantitas.attr('harga');
        var subtotal = kuantitas.attr('subtotal');
        var spanSubtotal = $(this).parent().parent().parent().next().find('.subtotal');
        if (kuantitas.val() - 1 < 1) {
            kuantitas.val(1);
        } else {
            kuantitas.val(kuantitas.val() - 1);
        }
        var value = kuantitas.val() * parseInt(harga);
        kuantitas.change();
        kuantitas.attr('subtotal', value);
        spanSubtotal.text(new Intl.NumberFormat('id').format(kuantitas.val() * parseInt(harga)));

        var totalHarga = 0;
        $('.kuantitas').each(function() {
            totalHarga += parseInt($(this).attr('subtotal'));
        });
        $('#totalHarga').text(new Intl.NumberFormat('id').format(totalHarga));

        var totalKuantitas = 0;
        $('.kuantitas').each(function() {
            totalKuantitas += parseFloat($(this).val());
        });
        $('#totalKuantitas').text(totalKuantitas);

        $(this).parent().parent().parent().next().next().find('.cartUpdate').removeAttr('disabled');
    });

    $('.plus').click(function() {
        var kuantitas = $(this).parent().parent().find('.kuantitas');
        var harga = kuantitas.attr('harga');
        var subtotal = kuantitas.attr('subtotal');
        var spanSubtotal = $(this).parent().parent().parent().next().find('.subtotal');
        kuantitas.val(parseInt(kuantitas.val()) + 1);
        var value = kuantitas.val() * parseInt(harga);
        kuantitas.change();
        kuantitas.attr('subtotal', value);
        spanSubtotal.text(new Intl.NumberFormat('id').format(kuantitas.val() * parseInt(harga)));

        var totalHarga = 0;
        $('.kuantitas').each(function() {
            totalHarga += parseInt($(this).attr('subtotal'));
        });
        $('#totalHarga').text(new Intl.NumberFormat('id').format(totalHarga));

        var totalKuantitas = 0;
        $('.kuantitas').each(function() {
            totalKuantitas += parseFloat($(this).val());
        });
        $('#totalKuantitas').text(totalKuantitas);

        $(this).parent().parent().parent().next().next().find('.cartUpdate').removeAttr('disabled');
    });

    $(".kuantitas").on('change keyup', function() {
        var kuantitas = $(this);
        var harga = kuantitas.attr('harga');
        var subtotal = kuantitas.attr('subtotal');
        var spanSubtotal = $(this).parent().parent().next().find('.subtotal');
        var value = kuantitas.val() * parseInt(harga);
        kuantitas.attr('subtotal', value);
        spanSubtotal.text(new Intl.NumberFormat('id').format(kuantitas.val() * parseInt(harga)));

        var totalHarga = 0;
        $('.kuantitas').each(function() {
            totalHarga += parseInt($(this).attr('subtotal'));
        });
        $('#totalHarga').text(new Intl.NumberFormat('id').format(totalHarga));

        var totalKuantitas = 0;
        $('.kuantitas').each(function() {
            totalKuantitas += parseFloat($(this).val());
        });
        $('#totalKuantitas').text(totalKuantitas);

        $(this).parent().parent().next().next().find('.cartUpdate').removeAttr('disabled');
    });

    $('.cartUpdate').on('click', function() {
        let link = $(this).attr('link');
        var button = $(this);
        var menu = $(this).attr('menu');
        var transaksi = $(this).attr('transaksi');
        var harga = $(this).attr('harga');
        var kuantitas = $(this).parent().parent().prev().prev().find('.kuantitas').val();
        $.ajax({
            url: link,
            data: {
                _token: '{{ csrf_token() }}',
                menu,
                kuantitas,
                harga,
                transaksi
            },
            method: 'put',
            dataType: 'json',
            success: function(response) {
                if (response.status == 1) {
                    $('#modalCenterLG').modal('hide');
                    button.attr('disabled', 'true')
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
                alert('error');
            }
        });
    });

    $('.cartDelete').on('click', function() {
        let link = $(this).attr('link');
        var menu = $(this).attr('menu');
        var transaksi = $(this).attr('transaksi');
        var nama = $(this).attr('nama');
        var div = $(this).parent().parent().parent().parent();
        Swal.fire({
            title: 'Are you sure?',
            text: "Apakah anda yakin ingin menghapus " + nama + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: link,
                    data: {
                        _token: '{{ csrf_token() }}',
                        menu,
                        transaksi
                    },
                    method: 'put',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 1) {
                            div.remove();
                            var totalHarga = 0;
                            $('.kuantitas').each(function() {
                                totalHarga += parseInt($(this).attr('subtotal'));
                            });
                            $('#totalHarga').text(new Intl.NumberFormat('id').format(
                                totalHarga));

                            var totalKuantitas = 0;
                            $('.kuantitas').each(function() {
                                totalKuantitas += parseFloat($(this).val());
                            });
                            $('#totalKuantitas').text(totalKuantitas);
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
                        alert('error');
                    }
                });
            }
        });
    });

</script>
