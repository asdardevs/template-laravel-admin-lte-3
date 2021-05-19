@extends('layouts.app')

@section('title')
Hasil Kuis
@endsection

@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Kuis || <span>{{$kelas['nama']}}</span> | <span>{{$pertemuan['nama']}}</span>| <span>{{$tugas['nama']}}</span></h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body" id="show">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Nim</th>
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
                        <a  target="_blank" href="{{url('lihat-hasil')}}/{{$item->refere_id}}/{{$item->mhs->id}}"
                          type="button" class="btn btn-success btn-sm">Lihat Hasil</a>
    
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


@push('addon-script')
    <script>

    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
      function lihat_hasil(refere_id, mhs_id){
          $.ajax({
                type: "POST",
                dataType: "json",
                data: ({
                    refere_id: refere_id ,
                    mhs_id: mhs_id ,
                  
                }),
                url: "{{ url('/lihat-hasil') }}",
                success: function (data) {
                  
                }
            })
      }
    </script>
@endpush

