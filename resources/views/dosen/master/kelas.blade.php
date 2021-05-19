@extends('layouts.app')

@section('title')
Kelas
@endsection

@section('content')


<section class="content">
    <div class="container-fluid">
     <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Kelas</h3>
              <button type="button" class="btn float-right btn-primary btn-sm add" >Tambah Data</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tabel" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Jumlah pertemuan</th>
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
                    <label for="kelas">Kelas</label>
                    <input type="text" class="form-control" id="kelas" name="kelas" placeholder="">
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
            ajax: "{{ url('/kelas') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'jumlah-pertemuan',
                    name: 'jumlah-pertemuan'
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
        $('.status').html('Tambah Kelas');
        $('.save').html('Tambah Kelas');
    });


    

  

    $(".save").click(function () {

        var formData = new FormData($('#form')[0]);
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');

        $.ajax({
            type: "POST",
            url: "{{ url('/kelas') }}",
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
        $('.status').html('Ubah Kelas');
        $('.save').html('<i class="fa fa-save"></i> Simpan Perubahan');
        $('#kode').val(id);
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $.get("{{ url('/kelas') }}" + '/' + id + '/edit', function (data) {
            $('#input').modal('show');
       
            $('#kelas').val(data.nama);

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
                    url: "{{ url('kelas') }}" + '/' + id,
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

