@extends('layouts.MainLayouts')
@section('title')
    <h1>{{ __('Biodata') }}</h1>
@endsection
@section('content')
    <h2 class="section-title">{{ Auth::user()->name }}</h2>
    <p class="section-lead">
        Sebelum melakukan aktivitas aplikasi, diharapkan absensi masuk terlebih dahulu.
    </p>
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h4>Presensi</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary" id="loaderChck" style="display:none" role="alert">
                        Mohon tunggu <i class="fas fa-spinner fa-pulse"></i>
                    </div>
                    <div class="table-responsive" id="listPresensi">

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 mt-2 mb-2">
                            <button class="btn btn-success btn-block" id="btnMasuk">
                                <i class="fas fa-check"></i> Masuk
                            </button>
                        </div>
                        <div class="col-md-6 col-sm-6 mt-2">
                            <button type="button" class="btn btn-warning btn-block" id="btnKeluar"><i
                                    class="fas fa-times-circle"></i>
                                Keluar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>First Name</label>
                                <input type="text" class="form-control" value="Ujang" required="">
                                <div class="invalid-feedback">
                                    Please fill in the first name
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Last Name</label>
                                <input type="text" class="form-control" value="Maman" required="">
                                <div class="invalid-feedback">
                                    Please fill in the last name
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-7 col-12">
                                <label>Email</label>
                                <input type="email" class="form-control" value="ujang@maman.com" required="">
                                <div class="invalid-feedback">
                                    Please fill in the email
                                </div>
                            </div>
                            <div class="form-group col-md-5 col-12">
                                <label>Phone</label>
                                <input type="tel" class="form-control" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Bio</label>
                                <textarea class="form-control summernote-simple"
                                    style="margin-top: 0px; margin-bottom: 0px; height: 121px;">Ujang maman is a superhero name in &lt;b&gt;Indonesia&lt;/b&gt;, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with &lt;b&gt;'John Doe'&lt;/b&gt;.</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group mb-0 col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="newsletter">
                                    <label class="custom-control-label" for="newsletter">Subscribe to newsletter</label>
                                    <div class="text-muted form-text">
                                        You will get new information about products, offers and promotions
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('after-script')
    <script>
        $(document).ready(function() {
            pageLoad();
            checkExists();

            $("#btnMasuk").on("click", function() {
                Masuk();
            });
            $("#btnKeluar").on("click", function() {
                Keluar();
            });
        });

        function pageLoad() {
            $.ajax({
                type: "get",
                url: "{{ route('presensi.read') }}",
                dataType: "HTML",
                beforeSend: function() {
                    $('#loaderChck').fadeIn('slow');
                },
                success: function(response) {
                    $('#loaderChck').fadeOut('slow');
                    $("#listPresensi").html(response);
                }
            });
        }

        function checkExists() {
            $.ajax({
                type: "get",
                url: "{{ route('presensi.check') }}",
                dataType: "json",
                success: function(response) {
                    if (response.check != '') {
                        $("#btnMasuk").attr("disabled", true);
                    }
                }
            });
        }

        function Masuk() {
            console.log('masuk')
            $.ajax({
                type: "get",
                url: "{{ route('presensi.masuk') }}",
                dataType: "json",
                success: function(response) {
                    pageLoad();
                    checkExists();
                    swal(response.msg, {
                        icon: "success",
                    });
                }
            });
        }

        function Keluar() {
            $.ajax({
                type: "get",
                url: "{{ route('presensi.keluar') }}",
                dataType: "json",
                success: function(response) {
                    pageLoad();
                    checkExists();
                    swal(response.msg, {
                        icon: "success",
                    });
                }
            });
        }
    </script>
@endpush
