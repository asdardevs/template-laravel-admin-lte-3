@extends('layouts.app')

@section('title')
Hasil Tugas
@endsection

@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data tugas | <span>{{$kelas['nama']}}</span> | <span>{{$pertemuan['nama']}}</span>| <span>{{$tugas['nama']}}</span></h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="200px">Nim</th>
                <th>Nama</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($jawaban as $item)
                <tr>
                    <td>{{$item->mhs->username}}</td>
                    <td>{{$item->mhs->name}}</td>
    
                    <td>
                      <div class="btn-group ">
                        <a  target="_blank" href="{{url('pertemuan')}}/{{$item->jawaban}}"
                          type="button" class="btn btn-success btn-sm">Download</a>
                      </div>
                    </td>
                  </tr>
                @endforeach
            

            </tbody>

          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </section>
@endsection


