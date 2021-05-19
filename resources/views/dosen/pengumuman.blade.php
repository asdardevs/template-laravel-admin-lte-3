@extends('layouts.app')

@section('title')
Pengumuman
@endsection



@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data notifikasi kuliah daring</h3>
          <button type="button" class="btn float-right btn-primary btn-sm add" >Tambah Data</button>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table id="tabel" class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Link</th>
                <th>Kelas</th>
                <th>waktu</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
      
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
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
                <form id="form">
                    <!-- link zoom -->
                    <div class="form-group row">
                      <label for="link" class="col-sm-2 col-form-label">Link</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control " id="link" name="link" placeholder="">
                      </div>
                    </div>
                    <!-- end link zoom -->
        
                    <!-- list pilihan kelas -->
                    <div class="form-group row">
                      <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                      <div class="col-sm-10">
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
                    </div>
                    <!-- end list pilihan kelas -->
        
                    <!-- input waktu mulai -->
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal mulai</label>
                      <div class="col-sm-10">
        
                        <!-- input tanggal -->
                        <input type="text" class="form-control datepicker mb-2" name="tanggal_mulai" id="tanggal_mulai" >
                        <!-- end input tanggal -->
        
                        <!-- input jam -->
                        <div class="input-group" >
                          <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="10:30" >
                          <div class="input-group-append" >
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                          </div>
                        </div>
                        <!-- end input jam -->
                      </div>
                    </div>
                    <!-- end input waktu mulai -->
        
                    <!-- input waktu selesai -->
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal selesai</label>
                      <div class="col-sm-10">
        
                        <!-- input tanggal -->
                        
                          <input type="text" class="form-control datepicker mb-2" name="tanggal_selesai" id="tanggal_selesai" >
                         
                        <!-- end input tanggal -->
        
                        <!-- input jam -->
                        <div class="input-group " >
                          <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="20:30" >
                          <div class="input-group-append" >
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                          </div>
                        </div>
                        
                        <!-- end input jam -->
                      </div>
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
        ajax: "{{ url('/dosen-pengumuman') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'link',
                name: 'link'
            },
            {
                data: 'kelas',
                name: 'kelas'
            },
            {
                data: 'waktu',
                name: 'waktu'
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
       $('.status').html('Tambah pengumuman');
       $('.save').html('Tambah pengumuman');
   });


   

 

   $(".save").click(function () {

       var formData = new FormData($('#form')[0]);
       var form = $('#form');
       form.find('.invalid-feedback').remove();
       form.find('.form-control').removeClass('is-invalid');

       $.ajax({
           type: "POST",
           url: "{{ url('/dosen-pengumuman') }}",
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
       $('.status').html('Ubah pengumuman');
       $('.save').html('<i class="fa fa-save"></i> Simpan Perubahan');
       $('#kode').val(id);
       var form = $('#form');
       form.find('.invalid-feedback').remove();
       form.find('.form-control').removeClass('is-invalid');
       $.get("{{ url('/dosen-pengumuman') }}" + '/' + id + '/edit', function (data) {
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
                   url: "{{ url('/dosen-pengumuman') }}" + '/' + id,
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



   $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: new Date()
        });
</script>
 

@endpush

