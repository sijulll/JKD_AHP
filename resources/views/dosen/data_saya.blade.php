@extends('layout.master_dosen')
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Saya</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    @foreach ($dosen as $d)
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputName">NIP</label>
                            <input type="text" id="" class="form-control" value="{{$d->nip}}" disabled>
                            <label for="inputName">Nama</label>
                            <input type="text" id="" class="form-control" value="{{$d->nama_dosen}}" disabled>
                            <label for="inputName">Jabatan</label>
                            <input type="text" id="" class="form-control" value="{{$d->jabatan->nama_jabatan}}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Mulai Menjabat</label>
                            <input type="text" id="" class="form-control" value="{{$d->mulai_menjabat}}" disabled>
                            @foreach ($qb as $qb)
                            <label for="inputProjectLeader">Poin Kum saya</label>
                            <input type="text" id="" class="form-control" value="{{$qb->kum}}" disabled>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- /.card-body -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data KUM Saya</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="table_jabatan" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Kegiatan</th>
                                    <th>Point Kum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($qbDetailKUM as $dk)
                                <tr>
                                    <td>{{$dk->nama_jk}}</td>
                                    <td>{{$dk->kum}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel Kelayakan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                    <div class="card-body">
                        <table id="table_jabatan" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Jabatan</th>
                                    <th>kelayakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proc as $p)
                                <tr>
                                    <td>{{$p->nama_jabatan}}</td>
                                    <td>{{$p->kesimpulan}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <!-- /.card -->

</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
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
    });

</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('select[name="jk_id"]').on('change', function () {
            var jk = jQuery(this).val();
            if (jk) {
                jQuery.ajax({
                    url: 'pengajuan/getKK/' + jk,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        jQuery('select[name="kk_id"]').empty();
                        jQuery.each(data, function (key, value) {
                            $('select[name="kk_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="kk_id"]').empty();
            }
        });
    });

</script>

@endsection
