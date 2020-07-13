@extends('layout.master')
@section('title')
Dosen - Jenjang Karier Dosen PNJ
@endsection

@section('head_link')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
{{-- ajax --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Kenaikan Jabatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Pengajuan Kenaikan Jabatan</li>
                        <li class="breadcrumb-item active"><a href="#">Create</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Input Form</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <form action="" method="POST" id="pengajuan_form">
                    <span id="result"></span>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jabatan Yang Di Ajukan :</label>
                                    <select class="form-control select2bs4" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Dosen</label>
                                    <select class="form-control select2bs4" data-placeholder="Plih Dosen"
                                        style="width: 100%;">
                                        <option>Dosen One </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Start Date:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" data-inputmask-alias="datetime"
                                            data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="field">
                            <div class="form-group">
                                <label>Jenis Kegiatan : </label>
                                <select class="form-control select2bs4" data-placeholder="Jenis Kegiatan" name="jk_id"
                                    style="width: 100%;">
                                    <option>JK Option 1</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Komponen Kegiatan : </label>
                                <select class="form-control select2bs4" data-placeholder="Komponen Kegiatan"
                                    name="kk_id" style="width: 100%;">
                                    <option>KK From JK Option Selected </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>File : </label>
                                <input type="file" id="file" name="file" class="input-file" accept=".pdf,.docs">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <div class="col-12 ">
                                <button id="add" name="add" class="btn btn-primary float-right">Tambah
                                    Kegiatan </button>
                            </div>
                        </div>
                        <br>
                        <!-- /.input group -->
                    </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="row">
            <div class="container-fluid">
                <div class="col-12 justify">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    @csrf
                    <input type="submit" name="save" id="save" value="Save" class="btn btn-success float-right">
                </div>
            </div>
            </form>
    </section>
</div>
@endsection
@section('footer_link')
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- Inputmask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<script>
    $(document).ready(function () {

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('yyyy-mm-dd', {
            'placeholder': 'yyyy-mm-dd'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        var count = 1;

        function pengajuan_form(number) {
            var html = '<div class="form-group">';
            html += ' <label>Jenis Kegiatan : </label>';
            html +=
                '<select class="form-control select2bs4" data-placeholder="Jenis Kegiatan" style="width: 100%;" name="jk_id[]">';
            html += '<option>JK Option 1</option>';
            html += '</select>';
            html += '</div>';
            html += '<div class="form-group">';
            html += ' <label>Komponen Kegiatan : </label>';
            html +=
                '<select class="form-control select2bs4" data-placeholder="Komponen Kegiatan" style="width: 100%;" name="kk_id[]">';
            html += '<option>Komponen Kegiatan</option>';
            html += '</select>';
            html += '</div>';
            html += '<div class="form-group">';
            html += '<label>File : </label>';
            html += '<input type="file" id="file[]" name="file[]" class="input-file" accept=".pdf,.docs">';
            html += '</div>';
            if (number > 1) {
                html +=
                    '<div class="form-group"> <div class="col-12 "> <button id="" name="remove" class="btn btn-danger float-right">Remove</button> </div> </div>';
                $('').append(html);
            } else {
                html +=
                    '<div class="form-group"> <div class="col-12 "> <button id="add" name="add" class="btn btn-primary float-right">Tambah Kegiatan</button> </div> </div> <br>';
                $('form').html(html);
            }
        }
        $(document).on('click', '#add', function () {
            count++;
            pengajuan_form(count);
        });

        $(document).on('click', '.remove', function () {
            count--;
            $(this).closest("<br>").remove();
        });

        $('pengajuan_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: '{{route("admin.pengajuan.store")}}',
                method: 'post',
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    $('#save').attr('disabled', 'disabled');
                },
                success: function (data) {
                    if (data.error) {
                        var error_html = '';
                        for (var count = 0; count < data.error.length; count++) {
                            error_html += '<p>' + data.error[count] + '</p>';
                        }
                        $('#result').html('<div class="alert alert-danger">' + error_html +
                            '</div>');
                    } else {
                        pengajuan_form(1);
                        $('#result').html('<div class="alert alert-success">' + data
                            .success + '</div>');
                    }
                    $('#save').attr('disabled', false);
                }
            })
        });
    });

</script>

@endsection
