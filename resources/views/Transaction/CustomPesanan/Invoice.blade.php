<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="{{ url('assets/css/style-invoice.css') }}" media="all" />
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ url('assets/img/logo-pos.jpeg') }}">
        </div>
        <h1>INVOICE NO {{ $listDataHeader->id_customPesanan }}</h1>
        <div id="company" class="clearfix">
            <div>Penerima:</div><br>
            <div>{{ $listDataHeader->nama_pelanggan }}</div>
            <div>{{ $listDataHeader->alamat }}</div>
            <div>082115420020</div>
            <div><a href="#">{{ $listDataHeader->email }}</a></div>
        </div>
        <div id="project">
            <div>Pengirim</div><br>
            <div><span>PROJECT</span> Website development</div>
            <div><span>CLIENT</span> John Doe</div>
            <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
            <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
            <div><span>DATE</span> August 17, 2015</div>
            <div><span>DUE DATE</span> September 17, 2015</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="desc">Deskripsi</th>
                    <th>KUANTITAS</th>
                    <th style="text-align: right">HARGA</th>
                    <th style="text-align: right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listDataBody as $item)
                    <tr>
                        <td style="text-align: left">{{ $item->Deskripsi }}</td>
                        <td style="text-align: center">{{ $item->kuantitas }}</td>
                        <td class="harga">{{ $item->Harga }}</td>
                        <td class="sbtl">{{ $item->Subtotal }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td style="text-align: left" colspan="2">{{ $dataJasa->nama_jasa }},
                        {{ $dataJasa->deskripsi }}</td>
                    <td class="hrgJs">{{ $dataJasa->harga_jasa }}</td>
                    <td class="sbtl2">{{ $dataJasa->subtotal2 }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="grand total ">GRAND TOTAL</td>
                    <td class="grand total grand-total">{{ $listDataHeader->total + $getDiskon->Disc }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="grand total">DISKON</td>
                    <td class="grand total discount">{{ $getDiskon->Disc }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="grand total">TOTAL BELANJA</td>
                    <td class="grand total totalBelanja">{{ $listDataHeader->total }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="total bayar">TOTAL BAYAR</td>
                    <td class="grand total totalBelanja">{{ $listDataHeader->total }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="sisa bayar">SISA BAYAR</td>
                    <td class="grand total totalBelanja">{{ $listDataHeader->total }}</td>
                </tr>
            </tbody>
        </table>

    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            window.onload = window.print;
            $("td.harga").each(function() {
                $(this).html(parseFloat($(this).text()).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            })
            $("td.sbtl").each(function() {
                $(this).html(parseFloat($(this).text()).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            })
            $("td.sbtl2").each(function() {
                $(this).html(parseFloat($(this).text()).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            })
            $("td.hrgJs").each(function() {
                $(this).html(parseFloat($(this).text()).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            })
            $("td.grand-total").each(function() {
                $(this).html(parseFloat($(this).text()).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            })
            $("td.discount").each(function() {
                $(this).html(parseFloat($(this).text()).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            })
            $("td.totalBelanja").each(function() {
                $(this).html(parseFloat($(this).text()).toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }));
            })

        });
    </script>
</body>

</html>
