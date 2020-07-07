@extends('layout.master')
@section('title')
    Kriteria - Jenjang Karier Dosen PNJ
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
            <h1>Kriteria</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kriterias Settings</li>
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
            <h3 class="card-title">Kriterias Settings</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool"  data-toggle="modal" data-target="#modal-create">
                  <i class="fas fa-plus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table_kriteria" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama kriteria</th>
                <th>Bobot</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
                  <?php $no=1; ?>
                  @foreach ($kriteriaData as $kriteria)

              <tr class="kriteria{{$kriteria->id}}">
              <td>{{ $no++ }}</td>
              <td>{{$kriteria->nama_kriteria}}</td>
              <td>{{$kriteria->bobot}}</td>
                <td>

                    <form action="{{ route('admin.kriteria.destroy', $kriteria->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                <a href="{{ route('admin.kriteria.edit',$kriteria->id)}}" class="btn btn-warning show-modal" data-id="{{$kriteria->id}}" data-nama="{{$kriteria->nama_kriteria}}" data-bobot="{{$kriteria->bobot}}" >
                        Edit
                </a>
                    <button type="submit" data-id="{{$kriteria->id}}" data-nama="{{$kriteria->nama_kriteria}}" data-bobot="{{$kriteria->bobot}}" class="btn btn-danger" >
                        Delete
                    </button>
                    </form>
                </td>
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
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <form action="{{route('admin.kriteria.store')}}" method="POST">
            {{ csrf_field() }}
        <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Nama Kriteria</label>
            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" placeholder="Nama Kriteria">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Bobot</label>
            <input type="text" class="form-control" id="bobot" name="bobot" placeholder="Masukan Bobot">
        </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

        {{-- <div class="modal fade" id="modal-update">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Update Data</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form role="form" role="modal">
                <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">ID</label>
                    <input type="email" class="form-control" id="fid" placeholder="Nama Jabatan">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Jabatan</label>
                    <input type="email" class="form-control" id="nama_jabatan" placeholder="Nama Jabatan">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Point Kum</label>
                    <input type="email" class="form-control" id="kum" placeholder="Point KUM">
                </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->


          <div class="modal fade" id="modal-delete">
            <div class="modal-dialog">
              <div class="modal-content bg-danger">
                <div class="modal-header">
                  <h4 class="modal-title">Delete Confirmation</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus data ?
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-outline-light actbutton">Yes, Delete</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div> --}}
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
