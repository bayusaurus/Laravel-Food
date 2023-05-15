<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #333;
            text-align: left;
            font-size: 18px;
            margin: 0;
        }

        .container {
            margin: 0 auto;
            height: auto;
            background-color: #fff;
        }

        caption {
            font-size: 28px;
            margin-bottom: 15px;
        }

        table {
            border: 1px solid #333;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td,
        tr,
        th {
            padding: 12px;
            border: 1px solid #333;
        }

        th {
            background-color: #f0f0f0;
        }

        h4,
        p {
            margin: 0px;
        }

    </style>
</head>

<body>
    <div class="container">
        <table>
            <caption>
                Restaurant
            </caption>
            <thead>
                <tr>
                    <th colspan="3">Invoice <strong>#{{ $transaksi->faktur }}</strong></th>
                    <th>{{ $transaksi->created_at->format('D, d M Y') }}</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Restaurant</h4>
                        <p>Jl Sultan Hasanuddin Makassar<br>
                            085343966997<br>
                        </p>
                    </td>
                    <td colspan="2">
                        <h4>Pelanggan: {{ $transaksi->nama }}</h4>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                @foreach ($menu as $data)
                    <tr>
                        <td>{{ $data->nama }}</td>
                        <td>Rp {{ number_format($data->harga) }}</td>
                        <td>{{ $data->kuantitas }}</td>
                        <td>Rp {{ number_format($data->subtotal) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="3">Subtotal</th>
                    <td>Rp {{ number_format($transaksi->total_bayar) }}</td>
                </tr>
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <td>Rp {{ number_format($invoice->total_price) }}</td>
                </tr>
            </tfoot> --}}
        </table>
    </div>
</body>

</html>
