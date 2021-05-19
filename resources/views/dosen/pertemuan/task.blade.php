<div class="callout callout-info">
    <div class="d-flex justify-content-between">
      <h5>Tugas</h5>
      <button type="button" class="btn float-right btn-primary btn-sm" onclick="tambahTask();" >Tambah Data</button>
    </div>

    <div class="card mt-3">
      <div class="card-body">
        <table class="table table-bordered table-striped" id="tabel-task">
          <thead>
            <tr>
              {{-- <th>No</th> --}}
              <th>Tugas</th>
              <th>Deadline</th>
              <th>Status </th>
              <th style="width: 270px">aksi</th>
            </tr>
          </thead>
          <tbody>
           
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>


  <div class="modal fade" id="modal-task">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="task-title">Tambah/edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-task">
            <input type="hidden" id="kode_task" name="kode_task" >
            <input type="hidden" id="pertemuan_task" name="pertemuan_task" value="{{$pertemuan['id']}}" >
            <div class="form-group row">
              <label for="nama_tugas" class="col-sm-3 col-form-label">Nama tugas</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_tugas" name="nama_tugas" placeholder="">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label">Deadline</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control datepicker" name="deadline" id="deadline" >
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label">File</label>
              <div class="col-sm-9">
                <div class="custom-file">
                  <input type="file" class="form-control custom-file-input" id="file_tugas" name="file_tugas" accept=".pdf,.docx,doc" >
                  <label class="custom-file-label" for="customFile" >Choose file (pdf/doc)</label>
                </div>
          
              </div>

             

            </div>

          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="simpan_task()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  
  <script>
   
    //  var pertemuan_id = ;
  
      function tambahTask(){
          $('#modal-task').modal('show');
          $('#task-title').html('Tambah Tugas');
  
      }


      
  
    function simpan_task(){
        var file = document.getElementById("file_tugas").files[0];
          var formData = new FormData($('#form-task')[0]);
          formData.append("file", file);
          var form = $('#form-task');
              form.find('.invalid-feedback').remove();
              form.find('.form-control').removeClass('is-invalid');
         
          $.ajax({
              type: "POST",
              url: "{{ url('/task-dosen') }}",
              data: formData,
              contentType: false,
              cache:false,
              processData: false,
              dataType:"json",
              success: function(data) {
                  if (data.status == true) {
                      $('#modal-task').modal('hide');
                      $('#form-task').each(function() {
                              this.reset();
                          });
                      var table = $('#tabel-task').DataTable();
                      table.row(this).remove().draw(false);
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
  
    function edit_task(id) {
        
          $('#task-title').html('Ubah Tugas');
          $('#kode_task').val(id);
        var form = $('#form-task');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $.get("{{ url('/task-dosen') }}" + '/' + id + '/edit', function (data) {
          $('#modal-task').modal('show');
            $('#nama_tugas').val(data.nama);
            $('#deadline').val(data.deadline);

        })
    }
  
  
    function hapus_task(id) {
          Swal.fire({
              title: 'Apakah anda yakin?',
              text: "Menghapus tugas",
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
                      url: "{{ url('task-dosen') }}" + '/' + id,
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
                          var table = $('#tabel-task').DataTable();
                          table.row(this).remove().draw(false);
                          
  
                      }
                  });
              }
  
  
          })
  
      }
  
   
  
    </script>