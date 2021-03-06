@extends('layout.master_dosen')
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(\Session::has('alert-success'))
                <div class="alert alert-success" aria-label="close">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div>{{Session::get('alert-success')}}</div>
                </div>
                @endif
                <div class="card-header">
                    <h3 class="card-title">Form Pengajuan Angka Kredit</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <form action="{{route('dosen.dosen.ajukan')}}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    <div class="card-body">
                        {{-- <div class="form-group">
                            <label>Jenis Kegiatan : </label>
                            <select class="form-control select2bs4" name="jk_id" id="jk_id" style="width: 100%;">
                                <option selected disabled>--- Pilih Jenis Kegiatan ---</option>
                                @foreach ($jkData as $jk => $val)
                                <option value="{{$jk}}">
                        {{$val}}
                        </option>
                        @endforeach
                        </select>
                    </div> --}}
                    <fieldset class="form-group">
                        <div class="row">
                            <label>Jenis Kegiatan : </label>
                          <div class="col-sm-10">

                            <?php $no=1; ?>
                            @foreach ($jkData as $jk => $val)
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="jk_id" id="jk_id{{$no++}}" value="{{$jk}}">
                            <label class="form-check-label" for="jk_id{{$no++}}">
                                {{$val}}
                              </label>
                            </div>
                            @endforeach
                          </div>
                        </div>
                      </fieldset>
                    <div class="form-group">
                        <label>Komponen Kegiatan : </label>
                        <select class="form-control select2bs4 " name="kk_id" id="kk_id" style="width: 100%;">
                            <option disabled="true" selected="true">--- Komponen Kegiatan ---</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>File (Only PDF):</label>
                        <input type="file" id="file" name="file" class="input-file" accept=".pdf">
                    </div>

            </div>
        </div>
        <!-- /.card-body -->
</div>
<!-- /.card -->
<div class="row">
    <div class="container-fluid">
        <div class="col-12 justify">
            <a href="{{route('dosen.dashboard')}}" class="btn btn-secondary">Cancel</a>
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
{{-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> --}}

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
    });

</script>
<script type="text/javascript">
   jQuery(document).ready(function () {
        jQuery('input[type=radio]').on('change', function () {
            var jk = jQuery(this).val();
            if (jk) {
                jQuery.ajax({
                    url: 'pengajuan/getKK/' +jk,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        jQuery('select[name="kk_id"]').empty();
                        jQuery.each(data, function (key, value) {
                            $('select[name="kk_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="kk_id"]').empty();
            }
        });
    });
</script>
@endsection
