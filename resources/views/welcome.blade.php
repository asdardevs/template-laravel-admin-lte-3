<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-learning - EFO </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('elearning')}}/plugins/fontawesome-free/css/all.min.css">
  
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('elearning')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('elearning')}}/dist/css/adminlte.min.css">
  <!-- css custom -->
  <link rel="stylesheet" href="{{url('elearning')}}/dist/css/landing.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{url('elearning')}}/dist/img/efo.png" width="70px" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto">
          <a href="{{url('login')}}" class="btn  btn-cs btn-sm my-2 my-sm-0 ml-2">Login</a>
          {{-- <a href="{{url('register')}}" class="btn btn-cs btn-sm my-2 my-sm-0  ml-2">Registrasi</a> --}}
          <button type="button" class="btn btn-cs-primary btn-sm my-2 my-sm-0  ml-3" data-toggle="modal"
            data-target="#panduan"> <i class="fas fa-book"></i>
            Panduan</button>
        </form>
      </div>
    </div>
  </nav>
  <!-- end navbar -->

  <!-- content -->
  <!-- slider -->
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{url('elearning')}}/dist/img/slide1.jpg" alt="First slide">

      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{url('elearning')}}/dist/img/slide2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{url('elearning')}}/dist/img/slided3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- end slider -->

  <!-- content body -->
  <div class="container py-5">
    <div class="row">
      <div class="col-md-6">
        <div class="position-relative p-3 "
          style="height: 180px;box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);">
          <div class="ribbon-wrapper ribbon-lg">
            <div class="ribbon bg-warning">
              Tentang
            </div>
          </div>
          <h4 class="font-weight-bold">
            EFO E-Learning
          </h4> <br>
          <small>E-Learning atau kuliah online EFO bertujuan untuk meningkatkan kualitas belajar mengajar.
            Dengan kuliah online ini memungkinkan Mahasiswa belajar tanpa batas waktu dan tempat.
            Kami menyebutnya Learning Without Limits.</small>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="far fa-heart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Sosial Media Kami</span>
                <span class="info-box-number">
                  <button type="button" class="btn btn-outline-info btn-xs"><i
                      class="fab fa-facebook-square"></i></button>
                  <button type="button" class="btn btn-outline-info btn-xs"><i class="fab fa-instagram"></i></button>
                  <button type="button" class="btn btn-outline-info btn-xs"><i class="fab fa-twitter"></i></button>
                  <button type="button" class="btn btn-outline-info btn-xs"><i class="fab fa-youtube"></i></button>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Guru/Dosen</span>
                <span class="info-box-number">000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Kontak</span>
                <span class="info-box-number">efo@gmail.com</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Siswa/Mahasiswa</span>
                <span class="info-box-number">000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
      </div>
    </div>
  </div>
  <!-- end content body -->

  <!-- footer -->
  <footer class="pb-3 bg-white">
    <div class="container">
      <div class="float-right d-none d-sm-block">
        <small> Elearning 4.0</small>
      </div>
      <small>Copyright © {{date('Y')}} <a href="#">EFO</a>. All rights
        reserved.</small>
    </div>
  </footer>
  <!-- end footer -->
  <!-- end content -->


  <!-- modal panduan elearning -->
  <div class="modal fade" id="panduan">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title mb-0">Panduan Penggunaan aplikasi E-learning EFO</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe src="https://drive.google.com/file/d/1bEFU4RCDeTZw7Qoj8GjDIHpbFa2Hg1E1/preview" width="100%"
            height="480"></iframe>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal panduan elearning -->

  <!-- jQuery -->
  <script src="{{url('elearning')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{url('elearning')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{url('elearning')}}/dist/js/adminlte.min.js"></script>

</body>

</html>
