@extends('layout.master_penilai')
@section('title')
    Komponen Kegiatan - Jenjang Karier Dosen PNJ
@endsection

@section('head_link')
      <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
            @if(Session::has('alert-success'))
                <div class="alert alert-success">
                    <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
                </div>
            @endif
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Komponen Kegiatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dosen.dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Tabel Komponen Kegiatan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <!-- Main content -->
 <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Komponen Kegiatan Beserta Angka Kredit</h3>
            <div class="card-tools">
                {{-- <button type="button" class="btn btn-tool"  data-toggle="modal" data-target="#modal-create">
                  <i class="fas fa-plus"></i></button> --}}
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table_kriteria" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Kategori Kegiatan</th>
                <th>Nama Kegiatan</th>
                <th>Kegiatan Poin</th>
                <th>Deskripsi</th>
              </tr>
              </thead>
              <tbody>
                  <?php $no=1; ?>
                  @foreach ($komponenkegiatanData as $komponenkegiatan)

              <tr class="komponenkegiatan{{$komponenkegiatan->id}}">
              <td>{{ $no++ }}</td>
              <td>
                {{$komponenkegiatan->jeniskegiatan->nama_jk}}
              </td>
              <td>{{$komponenkegiatan->nama_kegiatan}}</td>
              <td>{{$komponenkegiatan->kegiatan_point}}</td>
              <td>{{$komponenkegiatan->deskripsi}}</td>
              </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
</div>

@endsection

@section('footer_link')
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script type="text/javascript">
    $(function () {
      $("#table_kriteria").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });

    // function edit post
    $(document).on('click','.modal-update',function(){

    });
  </script>
@endsection
