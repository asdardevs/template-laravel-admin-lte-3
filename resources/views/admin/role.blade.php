@extends('layouts.app')
@section('title')
Role
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Data role akses menu aplikasi</h3>
                            <a class="btn btn-warning btn-sm add" href="#" >
                                <i class="fas fa-pencil-alt mr-2"></i>Tambah Role
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabel" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role</th>
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
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>



<!-- modal -->
{{-- <div class="modal fade" id="access">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Akses menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dashboard</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="1" value="option1">
                                    <label for="1" class="custom-control-label"></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> <i class="fas fa-minus ml-3 mr-2"></i> sub 1</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="2" value="option1">
                                    <label for="2" class="custom-control-label"></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td> <i class="fas fa-minus ml-3 mr-2"></i> sub 2</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="3" value="option1">
                                    <label for="3" class="custom-control-label"></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dispensi</td>
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" id="4" value="option1">
                                    <label for="4" class="custom-control-label"></label>
                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> --}}

<!-- modal tambah -->
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
                    <label for="nama_role">Nama Role</label>
                    <input type="text" class="form-control" id="nama_role" name="nama_role" placeholder="">
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
            ajax: "{{ url('/role') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name_role',
                    name: 'name_role'
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
        $('.status').html('Tambah Role');
        $('.save').html('Tambah Role');
    });

   
   function akses(){

        $('#access').modal('show');
   }
    

  

    $(".save").click(function () {

        var formData = new FormData($('#form')[0]);
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');

        $.ajax({
            type: "POST",
            url: "{{ url('/role') }}",
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
        $('.status').html('Ubah Role');
        $('.save').html('<i class="fa fa-save"></i> Simpan Perubahan');
        $('#kode').val(id);
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $.get("{{ url('role') }}" + '/' + id + '/edit', function (data) {
            $('#input').modal('show');
            $('#nama_role').val(data.name_role);

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
                    url: "{{ url('role') }}" + '/' + id,
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
