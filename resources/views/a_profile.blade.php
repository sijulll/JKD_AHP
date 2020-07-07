@extends('layout.master')
@section('title')
    User Profile Settings - Jenjang Karier Dosen PNJ
@endsection

@section('head_link')
      <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.min.css')}}">
@endsection
@section('content')

<div class="content-wrapper">
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
 <!-- Main content -->
 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="uploads/images/{{Auth::user()->image}}"
                     alt="User profile picture">
              </div>
              <h2 class="profile-username text-center">{{Auth::user()->username}}</h2>
              <p class="text-muted text-center">{{Auth::user()->email}}</p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#profile-settings" data-toggle="tab">Profile Settings</a></li>
                <li class="nav-item"><a class="nav-link" href="#profile-changepass" data-toggle="tab">Password Settings</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                <div class="active tab-pane" id="profile-settings">
                  <form class="form-horizontal" enctype="multipart/form-data" action="/aprofile" method="POST">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Username</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="username" placeholder="username" value="{{Auth::user()->username}}" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{Auth::user()->email}}" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Pilih Gambar</label>
                      <div class="col-sm-10">
                      <input type="file" name="img">
                      </div>
                    </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Save Change</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="profile-changepass">
                    <form class="form-horizontal" enctype="multipart/form-data" action="/profile" method="POST">
                      <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">Old Password</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="old_password" placeholder="Old Password" name="old_password">
                          </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="new_password" placeholder="Password"  name="new_password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password">
                        </div>
                      </div>
                  {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
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
