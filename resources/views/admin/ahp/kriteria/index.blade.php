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
@endsection
<section class="content">
    <div class="container-fluid">
    <div class="card card-default">
        <!-- /.card-header -->
        <!-- Horizontal Form -->
        <div class="card card-info">
            <!-- form start -->
            <form class="form-horizontal" action="/spk/kstore" method="POST">
            {{ csrf_field() }}
              <div class="card-body">
                <div class="form-group row">
                <label>Nama Kriteria</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="kriteria" placeholder="Masukan Nama Kriteria" required>

                    @if($errors->has('kriteria'))
                    <div class="text-danger">
                        {{ $errors->first('kriteria')}}
                    </div>
                    @endif

                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <input type="submit" class="btn btn-info" value="Simpan">
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
          <!-- /.card -->
        <!-- /.card-body -->
      </div>
   </div>
</section>
<section class="content">
    <div class="row">
      <div class="col-12">
      <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Kriteria</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Actions</th>
              </tr>
              </thead>
              <tbody>
              @php $no = 1; @endphp
            @foreach($kriteria as $k)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $k->kriteria }}</td>
                <td>
                    <a href="/spk/kshow/{{ $k->id }}" type="button" class="btn btn-warning btn-sm">Update</a>
                    <a href="/spk/kdlt/{{ $k->id }}" type="button" class="btn btn-danger btn-sm">
                    <!--<i class="fas fa-edit"></i>-->
                    Delete
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">Matriks Kriteria</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>-</th>
              @foreach($kriteria as $k)
              <th>{{ $k->kriteria }}</th>
              @endforeach
            </tr>
            </thead>
            <tbody>
              @foreach($nilai as $i)
              <tr>
                  <th>{{ $i->kriteria }}</th>
                  @foreach($i->NilaiKriteria1 as $j)
                  <td>{{ $j->nilai }}</td>
                  @endforeach
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</section>
