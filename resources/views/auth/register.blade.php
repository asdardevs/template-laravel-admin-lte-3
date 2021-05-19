<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-learning - EFO </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/fontawesome-free/css/all.min.css">
 
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('assets')}}/dist/css/adminlte.min.css">
  <!-- css custom -->
  <link rel="stylesheet" href="{{url('assets')}}/dist/css/landing.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page bg">

  <div class="login-box">
    <div class="login-logo">
      <img src="{{url('assets')}}/dist/img/efo.png" width="100px" alt="">
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Registrasi</p>
        <form method="POST" id="myForm" action="{{ route('register') }}">
            @csrf

            <div class="input-group ">
                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required  placeholder="Username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
                
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
              </div>
              <small  class="text-danger" >*Username gunakan NIM</small>
      
        
          <div class="input-group mb-3 mt-3">
     
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
          @enderror
          </div>
        

          <div class="input-group mb-3 mt-3">
            <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
      

          <div class="row">
            <div class="col-4">
                <button type="button" onclick="register()" class="btn btn-primary btn-block">
                    {{ __('Register') }}
                </button>
             
            </div>
          </div>
        </form>
        <p class="mb-1 pt-4">
            Do you have account ?
            <a href="{{'login'}}">Sign in.</a>
          </p>
        <div class="alert alert-danger alert-dismissible mt-4">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h5><i class="icon fas fa-exclamation-triangle"></i> Perhatian!</h5>
          Sebelum registrasi pastikan bahwa anda telah terdaftar pada matakuliah filsafat.
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="{{url('assets')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{url('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{url('assets')}}/dist/js/adminlte.min.js"></script>
    <!-- Toastr -->
    <script src="{{url('assets')}}/plugins/toastr/toastr.min.js"></script>

    <script type="text/javascript" src="{{url('assets')}}/sweetalert2/dist/sweetalert2.all.min.js"></script>


  <script>
    function register(){
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var username = $('#username').val();

            $.ajax({
                type: "POST",
                url: "{{ url('/cek-user') }}",
                data: {
                    username
                },
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    if (data.status == true) {
                        document.getElementById("myForm").submit();

                    } else {
                        $('#myForm').each(function () {
                            this.reset();
                        });
                        $(function () {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            Toast.fire({
                                icon: 'error',
                                title: data.message
                            })
                        });
                    }
                },


            });
        }
  </script>

</body>

</html>






{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
