@extends('layout.master')
@section('title')
Dosen - Jenjang Karier Dosen PNJ
@endsection

@section('head_link')
<!-- Toastr -->
<link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet" href="{{asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengajuan Kenaikan Jabatan</h1>
                </div>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Pengajuan Kenaikan Jabatan</li>
                        <li class="breadcrumb-item active"><a href="#">Create</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Form Pengajuan Angka Kredit</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <form action="" method="POST" id="pengajuan_form">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Dosen</label>
                            <select class="form-control select2bs4" name="dosen_id" id="dosen_id"
                                data-placeholder="Plih Dosen" style="width: 100%;">
                                <option selected disabled>--- Pilih Dosen ---</option>
                                @foreach ($dosenData as $dosen)
                                <option value="{{$dosen->nip}}">
                                    {{$dosen->nip}} || {{$dosen->nama_dosen}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan : </label>
                            <select class="form-control select2bs4 jk_id"  name="jk_id"
                                id="jk_id" style="width: 100%;">
                                <option selected disabled>--- Pilih Jenis Kegiatan ---</option>
                                @foreach ($jeniskegiatanData as $kk)
                                <option value="{{$kk->jk_id}}">
                                    {{$kk->nama_jk}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Komponen Kegiatan : </label>
                            <select class="form-control select2bs4 kk_id"
                                name="kk_id" id="kk_id" style="width: 100%;">
                                <option value="0" disabled="true" selected="true">Komponen Kegiatan</option>
                            </select>
                            {{-- {{ csrf_field() }} --}}
                        </div>
                        <div class="form-group">
                            <label>File : </label>
                            <input type="file" id="file" name="file" class="input-file" accept=".pdf,.docs">
                        </div>

                    </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="row">
            <div class="container-fluid">
                <div class="col-12 justify">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" name="save" id="save" value="Save" class="btn btn-success float-right">
                </div>
            </div>
            </form>
    </section>
</div>
@endsection
@section('footer_link')
<!-- Toastr -->
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
<!-- Inputmask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
{{-- <script src="http://code.jquery.com/jquery-3.4.1.js"></script> --}}

<script>
    $(document).ready(function () {

        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('yyyy-mm-dd', {
            'placeholder': 'yyyy-mm-dd'
        })
        //Money Euro
        $('[data-mask]').inputmask()

//         $('#jk_id').on('change', function(e){
//     console.log(e);
//     var jk_id = e.target.value;
//     $.get('/admin/pengajuan/create1?province_id=' + jk_id,function(data) {
//       console.log(data);
//       $('#kk_id').empty();
//       $('#kk_id').append('<option value="0" disable="true" selected="true">=== Select Regencies ===</option>');

//       $.each(data, function(index, kk_id){
//         $('#kk_id').append('<option value="'+ kk_id.id +'">'+ kk_id.name +'</option>');
//       })
//     });
//   });

    });

</script>
<script>
    $(document).ready(function(){

$(document).on('change','.jk_id',function(){
    // console.log("hmm its change");

    var jk_id=$(this).val();
    // console.log(cat_id);
    var div=$(this).parent();

    var op=" ";

    $.ajax({
        type:'get',
        url:'{!!URL::to('dd1')!!}',
        data:{'id':jk_id},
        success:function(data){
            //console.log('success');

            //console.log(data);

            //console.log(data.length);
            op+='<option value="0" selected disabled>chose product</option>';
            for(var i=0;i<data.length;i++){
            op+='<option value="'+data[i].id+'">'+data[i].productname+'</option>';
           }

           div.find('.kk_id').html(" ");
           div.find('.kk_id').append(op);
        },
        error:function(){

        }
    });
});
});

</script>
@endsection
