@extends('layout.master')
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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Log Aktifitas Penilai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Log Aktifitas Penilai</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                @if(\Session::has('alert'))
                <div class="alert alert-danger" aria-label="close">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>>
                    <div>{{Session::get('alert')}}</div>
                </div>
                @endif
                @if(\Session::has('alert-success'))
                <div class="alert alert-success" aria-label="close">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <div>{{Session::get('alert-success')}}</div>
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Log Aktifitas Penilai</h3>
                        {{-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-create">
                                <i class="fas fa-plus"></i></button>
                        </div> --}}
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table_kriteria" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aktifitas</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status Verifikasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach ($logData as $ld)

                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        {{$ld->keterangan}}
                                    </td>
                                    <td>{{$ld->datetime}}</td>
                                    <td>
                                        @if ($ld->data_baru == 1)
                                        <small class="badge badge-success">Diterima</small>
                                        @elseif ($ld->data_baru == 2)
                                        <small class="badge badge-danger">Ditolak</small>

                                        @endif
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
    $(document).on('click', '.modal-update', function () {

    });

</script>
@endsection
