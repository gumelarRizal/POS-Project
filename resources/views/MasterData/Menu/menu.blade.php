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
                    <div>
                        <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
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
                                                <th>Kategori Menu</th>
                                                <th>Harga Menu</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>
                                                <td>1</td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            $("#table-1").DataTable();
        });

    </script>
@endpush
