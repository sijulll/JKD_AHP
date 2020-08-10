@extends('layout.master')
@section('title')
    Dosen - Jenjang Karier Dosen PNJ
@endsection

@section('head_link')
      <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
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
            <li class="breadcrumb-item"><a href="{{route('admin.dosen.index')}}">Dosen Settings</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="card card-black">
          <div class="card-header">
            <h3 class="card-title">Create Data Dosen</h3>
          </div>
          <div class="card-body">
            <form action="{{route('admin.dosen.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nip">Email :</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="Email is Unique"  required >
                      </div>
                <div class="form-group">
                <label for="nip">Username :</label>
                  <input type="text" id="username" name="username" class="form-control" placeholder="Username"  required >
                  </div>
                  <div class="form-group">
                    <label for="nip">Default Password :</label>
                      <input type="password" id="password" name="password" class="form-control" placeholder="Type your password"  required >
                  </div>
                 <div class="form-group">
              <label for="nip">NIP :</label>
            <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP Dosen must be Unique"  required >
            </div>
            <div class="form-group">
                <label for="nip">Nama Dosen :</label>
              <input type="text" id="nama_dosen" name="nama_dosen" class="form-control" placeholder="Nama Dosen"  required >
            </div>
            <div class="form-group">
              <label for="Deskripsi">Alamat :</label>
            <textarea class="form-control" rows="3" id="alamat" name="alamat" required ></textarea>
            </div>
            <div class="form-group">
                <label for="nip">No Telpon :</label>
              <input type="text" id="no_tlp" name="no_tlp" class="form-control" placeholder="No telpom"  required >
            </div>
            <div class="form-group">
                <label for="inputStatus">Jabatan Saat Ini:</label>
                <select class="form-control custom-select" id="j_id" name="j_id" >
                  <option selected disabled>Select one</option>
                  @foreach ($jabatanData as $jabatan)
                <option value="{{$jabatan->id}}">
                    {{$jabatan->nama_jabatan}}
                </option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Mulai Masa Jabatan:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text"  name="mulai_menjabat" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      </div>
    <div class="row">
      <div class="col-12 justify" >
      <a href="{{route('admin.jeniskegiatan.index')}}" class="btn btn-secondary">Cancel</a>
        <input type="submit" value="Save Data" class="btn btn-success float-right">
      </div>
    </div>
    </form>
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

<script>
    $(function () {
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
      //Money Euro
      $('[data-mask]').inputmask()
    })
  </script>
@endsection
