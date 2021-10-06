@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Dashboard') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-money-bill-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pendapatan</h4>
                    </div>
                    <div class="card-body">
                        {{ 'Rp.' . number_format($totalPendapatan->Total_Pendapatan) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-money-bill-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        {{ 'Rp.' . number_format($totalPengeluaran->Total_pengeluaran) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Stok barang</h4>
                    </div>
                    <div class="card-body">
                        {{ number_format($totalStok->total_stok) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Persentase pendapatan</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart" width="500" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>List Barang</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <div class="row">
                            @foreach ($listBarang as $item)
                                <div class="col-md-4 col-sm-12 col-lg-4">
                                    <li class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <i class="fas fa-box"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>{{ $item->nama_barang }}</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $item->stok }}
                                            </div>
                                        </div>
                                    </li>
                                </div>
                            @endforeach
                        </div>
                    </ul>
                    <div class="text-center pt-1 pb-1">
                        <a href="{{ route('Menu.index') }}" class="btn btn-primary btn-lg btn-round">
                            View All
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
