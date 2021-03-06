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
                    <h1>Komponen Kegiatan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Komponen Kegiatan Settings</li>
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
                        <h3 class="card-title">Komponen Kegiatan Settings</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-create">
                                <i class="fas fa-plus"></i></button>
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
                                    <th>Actions</th>
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
                                    <td>

                                        <form
                                            action="{{ route('admin.komponenkegiatan.destroy', $komponenkegiatan->id) }}"
                                            method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <a href="{{ route('admin.komponenkegiatan.edit',$komponenkegiatan->id)}}"
                                                class="btn btn-warning show-modal" data-id="{{$komponenkegiatan->id}}"
                                                data-nama="{{$komponenkegiatan->nama_kegiatan}}"
                                                data-deskripsi="{{$komponenkegiatan->deskripsi}}">
                                                Edit
                                            </a>
                                            <button type="submit" data-id="{{$komponenkegiatan->id}}"
                                                data-nama="{{$komponenkegiatan->nama_kegiatan}}"
                                                data-deskripsi="{{$komponenkegiatan->deskripsi}}"
                                                class="btn btn-danger">
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
            <form action="{{route('admin.komponenkegiatan.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputStatus">Jenis Kegiatan</label>
                        <select class="form-control custom-select" id="jk_id" name="jk_id" required>
                            <option selected disabled>Select one</option>
                            @foreach ($jeniskegiatanData as $jeniskegiatan)
                            <option value="{{$jeniskegiatan->id}}">
                                {{$jeniskegiatan->nama_jk}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan"
                            placeholder="Nama Jenis Kegiatan" required>
                    </div>
                    <div class="form-group">
                        <label for="kegiatan_point">Poin Kegiatan</label>
                        <input type="text" class="form-control" id="kegiatan_point" name="kegiatan_point"
                            placeholder="Kegiatan Point" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi"></textarea>
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
