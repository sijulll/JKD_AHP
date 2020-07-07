@extends('layout.master')
@section('title')
    kriteria - Jenjang Karier Dosen PNJ
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
            <h1>kriteria</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.kriteria.index')}}">kriteria Settings</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
            <h3 class="card-title">Edit Data kriteria</h3>
          </div>
          <div class="card-body">

            @foreach ($kriteriaData as $kriteria)
            <form action="{{route('admin.kriteria.update', $kriteria->id)}}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
            <div class="form-group">
              <label for="nama_kriteria">Nama kriteria</label>
            <input type="text" id="nama_kriteria" name="nama_kriteria" class="form-control" placeholder="Nama kriteria" value="{{$kriteria->nama_kriteria}}" required >
              <label for="bobot">bobot</label>
            <input type="text" id="bobot" name="bobot" class="form-control" placeholder="Nilai bobot" value="{{$kriteria->bobot}}" required >
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      </div>
    <div class="row">
      <div class="col-12 justify" >
      <a href="{{route('admin.kriteria.index')}}" class="btn btn-secondary">Cancel</a>
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
<!-- DataTables -->
<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script type="text/javascript">
    $(function () {
      $("#example1").DataTable();
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
