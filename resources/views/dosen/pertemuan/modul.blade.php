<div class="callout callout-danger">
    <div class="d-flex justify-content-between">
      <h5>Modul pembelajaran</h5>
      <button type="button"  class="btn float-right btn-primary btn-sm"  onclick="tambahModul();">Tambah Data</button>
    </div>

   <div id="show-modul" ></div>

  </div>


    <!-- modal modul-->
    <div class="modal fade" id="modal-modul">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="modul-title">Upload/edit modul pembelajaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-modul">

              <input type="hidden" id="kode" name="kode" >
              <input type="hidden" id="pertemuan_id" name="pertemuan_id" value="{{$pertemuan['id']}}" >
              <div class="form-group">
                <label for="nama_modul">Nama Modul</label>
                <input type="text" class="form-control" id="nama_modul" name="nama_modul"  placeholder="Nama modul">
              </div>
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="form-control custom-file-input" id="file_modul" name="file_modul" accept=".pdf,.docx,doc" >
                  <label class="custom-file-label" for="customFile" >Choose file (pdf/doc)</label>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" onclick="simpan_modul()">Simpan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>



  <script>
   
  //  var pertemuan_id = ;

    function tambahModul(){
        $('#modal-modul').modal('show');
        $('#modul-title').html('Tambah Modul Pembalajaran');

    }
    

  function simpan_modul(){
      var file = document.getElementById("file_modul").files[0];
        var formData = new FormData($('#form-modul')[0]);
        formData.append("file", file);
        var form = $('#form-modul');
            form.find('.invalid-feedback').remove();
            form.find('.form-control').removeClass('is-invalid');
       
        $.ajax({
            type: "POST",
            url: "{{ url('/modul-dosen') }}",
            data: formData,
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function(data) {
                if (data.status == true) {
                    $('#modal-modul').modal('hide');
                    $('#form-modul').each(function() {
                            this.reset();
                        });
                  get_modul("{{$pertemuan['id']}}");
                  Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Berhasil..',
                      showConfirmButton: false,
                      timer: 1500
                    })
                    return false;

                } 
            },
            error: function(xhr){
                let response = xhr.responseJSON
                if($.isEmptyObject(response)==false){
                    $.each(response.errors, (key, value)=>{
                    
                        $('#'+key)
                            .closest('.form-control')
                            .addClass('is-invalid')
                            .after('<div  class="invalid-feedback" >  '+ value +'</div>')
                    })
                }
            }

        });
  }



  function hapus_modul(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Menghapus modul",
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
                    url: "{{ url('modul-dosen') }}" + '/' + id,
                    success: function (response) {
                       if (response.status == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Terhapus..',
                                showConfirmButton: false,
                                timer: 1500
                              })
                          } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Gagal terhapus..',
                                showConfirmButton: false,
                                timer: 1500
                              })
  
                          }
                        get_modul("{{$pertemuan['id']}}");

                    }
                });
            }


        })

    }

 

  </script>