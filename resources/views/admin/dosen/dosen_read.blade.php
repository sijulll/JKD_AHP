@extends('layout.master')
@section('title')
Dosen - Jenjang Karier Dosen PNJ
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
                    <h1>Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dosen Settings</li>
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
                        <h3 class="card-title">Dosen Settings</h3>
                        <div class="card-tools">
                            <a href="{{route('admin.dosen.create')}}" class="btn btn-success"> Add New </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="default" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Nama Dosen</th>
                                    <th>Alamat</th>
                                    <th>No Tlp</th>
                                    <th>Jabatan</th>
                                    <th>Mulai Menjabat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; ?>
                                @foreach ($dosenData as $dosen)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$dosen->nip}}</td>
                                    <td>{{$dosen->nama_dosen}}</td>
                                    <td>{{$dosen->alamat}}</td>
                                    <td>{{$dosen->no_tlp}}</td>
                                    <td>{{$dosen->jabatan->nama_jabatan}}</td>
                                    <td>{{$dosen->mulai_menjabat}}</td>
                                    <td>
                                            <a href="{{ route('admin.dosen.edit',$dosen->nip)}}"
                                                class="btn btn-warning " data-id="{{$dosen->nip}}"
                                                data-nama="{{$dosen->nama_jabatan}}" data-kum="{{$dosen->kum}}">
                                                Edit
                                            </a>
                                            <button data-toggle="modal" data-target="#modal-delete"
                                                class="btn btn-danger">
                                                Delete
                                            </button>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal fade" id="modal-delete">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.dosen.destroy', $dosen->nip) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Confirmation</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>Yakin ingin menghapus data ?</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Yes, Delete</button>
                        </div>
                    </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
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
        $("#default").DataTable();
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
