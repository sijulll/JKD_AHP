@extends('layout.master_penilai')
@section('title')
    Penilai - Jenjang Karier Dosen PNJ
@endsection

@section('head_link')
      <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Aprroval</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('penilai.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('penilai.approval.index')}}">Dosen Settings</a></li>
              <li class="breadcrumb-item active">Data Approval</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-black">
          <div class="card-header">
            <h3 class="card-title">Edit Data Dosen</h3>
          </div>
          <div class="card-body">
            @foreach ($pengajuanData as $pengajuan)
            <form action="{{route('penilai.approval.update', $pengajuan->id)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                  <div class="form-group">
                      <label for="nip">Nama Dosen :</label>
                    <input type="text" id="dosen_id" name="dosen_id" class="form-control" placeholder="Nama Dosen" value="{{$pengajuan->dosen->nama_dosen}}"  disabled>
                  </div>
                  <div class="form-group">
                    <label for="Deskripsi">Kategori Kegiatan :</label>
                  <textarea class="form-control" rows="3" id="kk_id" name="kk_id" required disabled>{{$pengajuan->komponenkegiatan->nama_kegiatan}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="file">File :</label>
                  <a href="/uploads/pdf/{{$pengajuan->file}}" class="btn btn-info"><i class="fa-file-pdf"></i> Lihat Document</a>
                  </div>
                  <div class="form-group">
                      <label for="inputStatus">Keputusan :</label>
                      <select class="form-control custom-select" id="status" name="status" >
                      <option value="1">Setujui</option>
                      <option value="2">Tolak</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="Deskripsi">Note :</label>
                  <textarea class="form-control" rows="3" id="note" name="note" placeholder="Berikan Alasan saat penolokan pengajuan" ></textarea>
                  </div>

                  </div>
                </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    <div class="row">
      <div class="col-12 justify" >
      <a href="{{route('admin.dosen.index')}}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Save Data" class="btn btn-success float-right">
      </div>
    </div>
    </form>
    @endforeach
  </section>
  <!-- /.content -->
 </div>

@endsection

@section('footer_link')
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- Inputmask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>

<script type="text/javascript">
   <script>
    $(function () {
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
      //Money Euro
      $('[data-mask]').inputmask()
    })
  </script>
@endsection
