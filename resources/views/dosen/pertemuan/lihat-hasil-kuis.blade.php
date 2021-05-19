@extends('layouts.app')

@section('title')
Hasil {{$mhs['name']}}
@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Hasil quiz | <span>{{$mhs['name']}}</span></h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">

              <!-- soal -->
              <ul class="list-quiz">
                  @foreach ($jawaban as $jawaban)
                  <li>
                    <div class="form-group">
                      <p>  {!! $jawaban->soal->soal !!}</p>
                      <b>
                        jawaban:
                      </b>
                      <p>{!!$jawaban->jawaban!!}</p>
                    </div>
                  </li>
                  @endforeach
                
              


              </ul>
              <!-- end soal -->
              <div class="row">
                <div class="col-md-12 text-center">
                  {{-- <a href="hasil-quiz.html" type="button" class="btn btn-default">Kembali</a> --}}
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>
@endsection


