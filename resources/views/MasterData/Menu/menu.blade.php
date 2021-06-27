@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Master Data Menu') }}</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('List Data Menu') }}</h4>
                </div>
                <div class="card-body">
                    <div class="col-sm-12">
                        <form action="">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="">Kode Menu</label>
                                    <div class="form-group">
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="">Nama Menu Menu</label>
                                    <div class="form-group">
                                        <input type="text" name="" id="" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-left">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                            <i class="fas fa-plus"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm"><i class="fas fa-search" id="search"></i>
                                            Search</button>
                                        <button class="btn btn-secondary btn-sm"><i class="fas fa-cycle"></i>
                                            Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-striped dataTable no-footer" id="table-1" role="grid"
                            aria-describedby="table-1_info">
                            <thead>
                                <tr>
                                    <th class="text-center sorting_asc">
                                        #
                                    </th>
                                    <th>ID Menu</th>
                                    <th>Nama Menu</th>
                                    <th>Harga Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 0;
                                @endphp
                                @foreach ($listMenu as $item)
                                    @php
                                        $no++;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $item->id_menu }}</td>
                                        <td>{{ $item->Nama_menu }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td align="center">
                                            <a class="btn bg-danger btn-sm">
                                                <i class="fas fa-trash"> Hapus </i>
                                            </a>
                                            <a class="btn bg-warning btn-sm">
                                                <i class="fas fa-edit"> Edit </i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('after-script')
        <script>
            $(document).ready(function() {
                $("#table-1").DataTable({
                    searching: false,
                });

                $("#saveChanges").click(function(e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('Menu.store') }}",
                        method: "post",
                        data: $("#formMenu").serialize(),
                        success: function(resp) {
                            alert(resp.msg);
                            $("#table-1").DataTable().data();
                        }
                    })
                })
            });
        </script>
    @endpush
@endsection
@section('modal')
    @include('MasterData.Menu.modalMenu')
@endsection
