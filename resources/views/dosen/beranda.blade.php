@extends('layouts.app')

@section('title')
Beranda
@endsection

@section('content')


<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">MK- Filsafat Ilmu</h3>
      </div>
      <div class="card-body">
        @foreach ($kelas as $kelas)
        @php
            $jml = DB::table('meetings')->where('kelas_id', $kelas->id)->count();
        @endphp
       
          @if ($jml == 0).

          <a href="#" onclick="pertemuan();" class="btn btn-app">
          <span class="badge bg-danger">{{$jml}}</span>
          @else
          <a href="{{url('pertemuan')}}/{{$kelas->id}}" class="btn btn-app">
          <span class="badge bg-success">{{$jml}}</span>
          @endif
         
          <i class="fas fa-users"></i> {{$kelas->nama}}
        </a>
        @endforeach
      
        
      </div>
    </div>
  </div>
</section>

@endsection

@push('addon-script')
  <script>
    function pertemuan(){
      Swal.fire(
      'Pertemuan kosong ',
      'Tidak menemukan pertemuan di kelas ini ',
      'error'
    )
    }
    </script>  
@endpush


