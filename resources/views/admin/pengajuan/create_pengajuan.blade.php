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
                      <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    </div>
                  </div>
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
                        <select class="select2"  data-placeholder="Plih Dosen" style="width: 100%;">
                          <option>Dosen One </option>
                        </select>
                      </div>
                        <div class="form-group">
                        <label>Start Date:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                        </div>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="field">
                  <div class="field0">
                    <div class="form-group">
                        <label>Jenis Kegiatan : </label>
                        <select class="select2" data-placeholder="Jenis Kegiatan" style="width: 100%;">

                          <option>JK Option 1</option>
                        </select>
                      </div>
                    <div class="form-group">
                        <label>Komponen Kegiatan : </label>
                        <select class="select2"  data-placeholder="Komponen Kegiatan" style="width: 100%;">
                          <option>KK From JK Option Selected </option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Komponen Kegiatan : </label>
                        <div class="col-md-4">
                          <input type="file" id="action_json" name="action_json" class="input-file" accept=".txt,.json">
                          <div id="document_upload"></div>
                          </div>
                      </div>
                      </div>
                      </div>
                      <!-- Button -->
                      <div class="form-group">
                          <div class="col-12 ">
                          <button id="add-more" name="add-more" class="btn btn-primary float-right">Tambah Kegiatan</button>
                          </div>
                      </div>
                      <br><br>
                        <!-- /.input group -->
                      </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            <div class="row">
            <div class="container-fluid">
              <div class="col-12 justify" >
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create new Porject" class="btn btn-success float-right">
              </div>
            </div>
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
    $(function () {

                //Initialize Select2 Elements
                $('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
theme: 'bootstrap4'
})
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
      //Money Euro
      $('[data-mask]').inputmask()
    })
  </script>
@endsection
