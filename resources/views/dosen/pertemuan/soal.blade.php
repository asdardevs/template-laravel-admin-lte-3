@extends('layouts.app')
@section('title')
Soal 
@endsection

@push('addon-style')
<link rel="stylesheet" href="{{url('elearning')}}/summernote/summernote-bs4.css">
@endpush

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row" id="list">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Data Soal </h3>
                            <a class="btn btn-warning btn-sm add" href="#" >
                                Tambah Soal
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabel" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Soal</th>
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

        {{-- start input --}}
        <div class="row" id="input">
            <div class="col-md-12">
                <div class="card">
        
                    <div class="card-body">
                        <form id="form">
                            <input type="hidden" name="kode" id="kode">
                            <input type="hidden" name="kuis_id" id="kuis_id" value="{{$kuis->id}}">

                                <div class="col">
                                    <small class="form-text text-muted mb-1">Soal</small>
                                    <textarea  name="soal" id="summernote" cols="30" rows="10"></textarea>                    
                                </div>
                               
                        </form>

                    </div>
                   
                  
                </div>
                <div class="d-flex flex-row-reverse mb-3">
                <button   class="btn btn-primary  save">Simpan</button>&nbsp;
                <button onclick="batal(); return false;" id="batal" class="btn btn-default"> Batal</button>
              </div>

             
            </div>
        </div>
        {{-- end input --}}
    </div>
    <!-- /.container-fluid -->
</section>





@endsection



@push('addon-script')

<script src="{{url('elearning')}}/summernote/summernote-bs4.min.js"></script>

<script>
        $('#summernote').summernote({
            height: 200
        });
        function tambah(stat) {
            $('#input').show(300);
            $('#list').hide(300);

            $('#summernote').summernote('code', '');
        }
        function batal() {
            $('#summernote').summernote('code', '');
           

            $('#input').hide(300);
            $('#list').show(300);
            $('#form').each(function() {
                this.reset();
            });
            $('.save').html('<i class="fa fa-save"></i> Simpan');    
        }
    $(document).ready(function () {
        $('#input').hide();
        
        var kuis_id = "{{$kuis['id']}}";
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var table = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            paging:   false,
            ordering: false,
            info:     false,
            searching: false,
            ajax: "{{ url('/soal-ajax') }}" + '/' + kuis_id ,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {data: 'soal', name: 'soal'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });



    $(".add").click(function() {
            $('#form').each(function() {
                this.reset();
            });
            $('#kode').val('');
            var form = $('#form');
                form.find('.invalid-feedback').remove();
                form.find('.form-control').removeClass('is-invalid');
            $('#input').show(300);
            $('#list').hide(300);
            $('.save').html('Tambah soal');
        });

    $(".save").click(function() {
        

        var formData = new FormData($('#form')[0]);
        var form = $('#form');
            form.find('.invalid-feedback').remove();
            form.find('.form-control').removeClass('is-invalid');
        // var icon = document.getElementById("icon").files[0];
        //     formData.append("icon", icon);
        $.ajax({
            type: "POST",
            url: "{{ url('/soal-dosen') }}",
            data: formData,
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function(data) {
                if (data.status == true) {
                    batal();
                    $('#form').each(function() {
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
            error: function(xhr){
                let response = xhr.responseJSON
                if($.isEmptyObject(response)==false){
                    $.each(response.errors, (key, value)=>{
                    
                        Swal.fire(
                                'Error ..!!',
                                 `${value}`,
                                'error'
                                )
                        // $('#'+key)
                        //     .closest('.form-control')
                        //     .addClass('is-invalid')
                        //     .after('<div  class="invalid-feedback" >  '+ value +'</div>')
                    })
                }
            }

        });
    });

    function edit(id) {

       $('.save').html('<i class="fa fa-save"></i> Simpan Perubahan');
       $('#kode').val(id);
       var form = $('#form');
           form.find('.invalid-feedback').remove();
           form.find('.form-control').removeClass('is-invalid');
       $.get("{{ url('soal-dosen') }}" +'/' + id +'/edit', function (data) {
         
           $('#input').show(300);
           $('#list').hide(300);

           $("#summernote").summernote("code", data.soal);
        //    $('#summernote').val(data.deskripsi);
          
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
                    url: "{{ url('soal-dosen') }}" + '/' + id,
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
