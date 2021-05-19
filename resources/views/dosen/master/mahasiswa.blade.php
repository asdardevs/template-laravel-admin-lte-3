@extends('layouts.app')

@section('title')
Mahasiswa
@endsection

@section('content')


<section class="content">
    <div class="container-fluid">
     <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Mahasiswa</h3>
              <button type="button" class="btn float-right btn-primary btn-sm add" >Tambah Data</button>
              <a href="{{url('create-mahasiswa')}}" class="btn float-right btn-warning btn-sm mr-3" >Buat User</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabel" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Angkatan</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                    
                  </tr>
                </thead>
                <tbody>
                 
                 
                </tbody>
              </table>
            </div>
          </div>
     </div>
    </div>
  </section>


  <div class="modal fade" id="input">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="status">Tambah data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form id="form" >
                   <input type="hidden" id="kode" name="kode" >
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim" placeholder="">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="">
                </div>
                <div class="form-group">
                    <label for="angkatan">Angkatan</label>
                    <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="">
                </div>
                <div class="form-group">
                    <label for="kelas">Kelas</label>
                    <select class="custom-select" name="kelas" id="kelas">
                        <option value=""selected disabled>Pilih Kelas</option>
                        @php
                             $role =  DB::table('classrooms')->get();
                        @endphp
                        @foreach ($role as $r)
                        <option value='{{$r->id}}'>{{$r->nama}}</option>
                        @endforeach
                        </select>
                </div>
               </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary save">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



@endsection


@push('addon-script')

<script>
   $(document).ready(function () {

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/mahasiswa') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nim',
                    name: 'nim'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'angkatan',
                    name: 'angkatan'
                },
                {
                    data: 'kelas.nama',
                    name: 'kelas.nama'
                },
               
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
               
                
            ]
        });

    });

    
    $(".add").click(function () {
        $('#form').each(function () {
            this.reset();
        });
        $('#kode').val('');
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $('#input').modal('show');
        $('.status').html('Tambah mahasiswa');
        $('.save').html('Tambah mahasiswa');
    });


    

  

    $(".save").click(function () {

        var formData = new FormData($('#form')[0]);
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');

        $.ajax({
            type: "POST",
            url: "{{ url('/mahasiswa') }}",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == true) {
                    $('#input').modal('hide');
                    $('#form').each(function () {
                        this.reset();
                    });
                    var table = $('#tabel').DataTable();
                    table.row(this).remove().draw(false);
                    toastr.success("Data berhasil disimpan...", 'Berhasil', {
                        timeOut: 5000
                    });
                    return false;

                }
            },
            error: function (xhr) {
                let response = xhr.responseJSON
                if ($.isEmptyObject(response) == false) {
                    $.each(response.errors, (key, value) => {

                        if (key=='kelas' ) {
                          $('#'+key).addClass('is-invalid')
                          .after('<div  class="invalid-feedback" >  '+ value +'</div>')
                      }
                        $('#' + key)
                            .closest('.form-control')
                            .addClass('is-invalid')
                            .after('<div  class="invalid-feedback" >  ' + value + '</div>')
                    })
                }
            }

        });
    });

    function edit(id) {
        $('.status').html('Ubah mahasiswa');
        $('.save').html('<i class="fa fa-save"></i> Simpan Perubahan');
        $('#kode').val(id);
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $.get("{{ url('/mahasiswa') }}" + '/' + id + '/edit', function (data) {
            $('#input').modal('show');
            $('#nim').val(data.nim);
            $('#nama').val(data.nama);
            $('#angkatan').val(data.angkatan);
            $('#kelas').val(data.kelas_id);

        })
    }

    function hapus(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f00',
            cancelButtonText: 'Batal',
            cancelButtonColor: '#D0D0D0',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ url('mahasiswa') }}" + '/' + id,
                    success: function (response) {
                        if (response.status == true) {
                            toastr.success(response.message, 'Terhapus', {
                                timeOut: 5000
                            });
                        } else {
                            toastr.error(response.message, 'Gagal', {
                                timeOut: 5000
                            });

                        }
                        var table = $('#tabel').DataTable();
                        table.row(this).remove().draw(false);

                    }
                });
            }


        })

    }


</script>
    
@endpush

