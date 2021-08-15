<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        * {
            font-family: Arial, sans-serif;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        p {
            font-size: 10px;
        }

        .top-min {
            margin-top: -10px;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .bold {
            font-weight: bold;
        }

        .d-block {
            display: block;
        }

        hr {
            border: 0;
            border-top: 1px solid #000;
        }

        .hr-dash {
            border-style: dashed none none none;
        }

        table {
            font-size: 10px;
        }

        table thead tr td {
            padding: 5px;
        }

        .w-100 {
            width: 100%;
        }

        .line {
            border: 0;
            border-top: 1px solid #000;
            border-style: dashed none none none;
        }

        .body {
            margin-top: -10px;
        }

        .b-p {
            font-size: 12px !important;
        }

        .w-long {
            width: 80px;
        }

    </style>
</head>

<body>
    <div class="header">
        <p class="uppercase bold d-block center b-p">PT. Arkamaya</p>
        <p class="top-min d-block center">Jl. Buah Batu</p>
        <p class="top-min d-block center">082115420020</p>
        <hr class="hr-dash">
        <table class="w-100">
            <tr>
                <td class="left w-long">Kode Transaksi : </td>
                <td class="left">{{ $listHeader->id_checkout }}</td>
                <td class="right">Kasir : </td>
                <td class="right">{{ $listHeader->Cashier }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="left" colspan="3">{{ date('Y-m-d') }}</td>
            </tr>
        </table>
        <hr class="hr-dash">
    </div>
    <div class="body">
        <table class="w-100">
            <thead>
                <tr>
                    <td>Nama Barang</td>
                    <td>Qty</td>
                    <td>Harga</td>
                    <td>Jumlah</td>
                </tr>
                <tr>
                    <td colspan="4" class="line"></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($listDetail as $transaksi)
                    <tr>
                        <td>{{ $transaksi->nama_barang }}</td>
                        <td>{{ $transaksi->qty }}</td>
                        <td>{{ number_format($transaksi->harga_barang, 0, ',', '.') }}</td>
                        <td>{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr class="hr-dash">
        <table class="w-100">
            <tr>
                <td class="left">Subtotal (Jumlah : )</td>
                <td class="right">{{ number_format($listHeader->total + $listHeader->Diskon, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td class="left">Diskon</td>
                <td class="right">{{ number_format($listHeader->Diskon, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="left">Total</td>
                <td class="right">{{ number_format($listHeader->total, 0, ',', '.') }}
                </td>
            </tr>
        </table>
        <hr class="hr-dash">
        <table class="w-100">
            <tr>
                <td class="left">Bayar</td>
                <td class="right"></td>
            </tr>
            <tr>
                <td class="left">Kembali</td>
                <td class="right"></td>
            </tr>
        </table>
        <hr class="hr-dash">
    </div>
    <div class="footer">
        <p class="center">Terima Kasih Telah Berkunjung</p>
    </div>
</body>

</html>
