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
            font-size: 14px;
            margin: 0;
        }

        .container {
            margin: 0 auto;
            height: auto;
            background-color: #fff;
        }

        caption {
            font-size: 24px;
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
            padding: 10px;
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
                {{ $title }}
            </caption>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Faktur</th>
                    <th>Meja</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaksi->nama }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>{{ $transaksi->faktur }}</td>
                        <td>{{ $transaksi->meja }}</td>
                        <td>Rp. {{ number_format($transaksi->total_bayar, 0, '.', '.') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="5">Total</th>
                    <td>Rp {{ number_format($omset->total, 0, '.', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
