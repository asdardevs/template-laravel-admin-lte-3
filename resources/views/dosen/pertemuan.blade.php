@extends('layouts.app')

@section('title')
Beranda
@endsection

@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">MK- Filsafat Ilmu | <span>{{$kelas['nama']}}</span></h3>

        </div>
        <div class="card-body">

        
            @foreach ($pertemuan as $item)
            <a href="{{url('detail-pertemuan')}}/{{$item->id}}" class="btn btn-app">
                <i class="fas fa-users"></i> {{$item->nama}}
              </a> 
            @endforeach
       
        
        </div>
      </div>
    </div>
  </section>



@endsection


