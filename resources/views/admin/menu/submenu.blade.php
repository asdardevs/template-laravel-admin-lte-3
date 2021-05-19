@extends('layouts.app')

@section('title')
Sub Menu
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Data sub menu aplikasi</h3>
                            <a class="btn btn-warning btn-sm add" >
                              </i>Tambah data
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabel" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Sub Menu</th>
                                    <th>Url</th>
                                    <th>Urutan</th>
                                    <th>Aktif</th>
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
                   <input type="hidden" name="kode" id="kode" >
                <div class="form-group row">
                    <label for="menu" class="col-sm-4 col-form-label">Menu</label>
                    <div class="col-sm-8">
                        <select class="custom-select" id="menu" name="menu" >
                            <option value=""selected disabled>Pilih Menu</option>
                            @php
                                 $role =  DB::table('menus')->get();
                            @endphp
                            @foreach ($role as $r)
                            <option value='{{$r->id}}'>{{$r->menu}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="submenu" class="col-sm-4 col-form-label">Nama Sub menu</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="submenu" name="submenu" placeholder="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sub_url" class="col-sm-4 col-form-label">Url</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sub_url" name="sub_url" placeholder="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="urutan" class="col-sm-4 col-form-label">Urutan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="urutan" name="urutan" placeholder="" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Aktif</label>
                    <div class="col-sm-8">
                        <select class="custom-select" name="is_active" id="is_active" >
                            <option value="1" >Aktif</option>
                            <option value="0" >Tidak aktif</option>
                        </select>
                    </div>
                </div>
               </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-primary save">Simpan</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- <button type="button" title="Lihat" class="btn btn-outline-warning" onClick="lihat(\'' . $rowi->id . '\'); return false;" ><i class="fas  fa-eye fa-sm"></i></button> --}}
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
            ajax: "{{ url('/sub-menu') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'menu.menu',
                    name: 'menu.menu'
                },
                {
                    data: 'sub',
                    name: 'sub'
                },
                {
                    data: 'sub_url',
                    name: 'sub_url'
                },
                
                {
                    data: 'urut_sub',
                    name: 'urut_sub'
                },
                {
                    data: 'aktif',
                    name: 'aktif'
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
        $('.status').html('Tambah SUb Menu');
        $('.save').html('Tambah Sub menu');
    });


    $(".save").click(function () {

        var formData = new FormData($('#form')[0]);
        var form = $('#form');
            form.find('.invalid-feedback').remove();
            form.find('.form-control').removeClass('is-invalid');
            form.find('#menu').removeClass('is-invalid');
       

        $.ajax({
            type: "POST",
            url: "{{ url('/sub-menu') }}",
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
                    $(function() {
                        const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                        });
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        })
                    });

                      
                        
                    return false;

                }
            },
            error: function (xhr) {
                let response = xhr.responseJSON
                if ($.isEmptyObject(response) == false) {
                    $.each(response.errors, (key, value) => {
                        // console.log(key);
                        if (key=='menu' ) {
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
        $('.status').html('Ubah Sub Menu');
        $('.save').html('<i class="fa fa-save"></i> Simpan Perubahan');
        $('#kode').val(id);
        var form = $('#form');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $.get("{{ url('sub-menu') }}" + '/' + id + '/edit', function (data) {
            $('#input').modal('show');
            $('#menu').val(data.menu_id);
            $('#submenu').val(data.sub);
            $('#sub_url').val(data.sub_url);
            $('#urutan').val(data.urut_sub);
            $('#is_active').val(data.is_active);

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
                    url: "{{ url('sub-menu') }}" + '/' + id,
                    success: function (response) {
                        if (response.status == true) 
                            $(function() {
                                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                                });
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                })
                            });
                        
                        else 
                            $(function() {
                                const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                                });
                                Toast.fire({
                                    icon: 'error',
                                    title: response.message
                                })
                            });

                        
                        var table = $('#tabel').DataTable();
                        table.row(this).remove().draw(false);

                    }
                });
            }


        })

    }

</script>
@endpush

