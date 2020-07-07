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
            <h1>Dashboard Admin</h1>
          </div>
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
Dashboard Admin Nih !!
        </div></div></section></div>
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
