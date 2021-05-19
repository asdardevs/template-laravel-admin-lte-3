<div class="callout callout-warning">
    <div class="d-flex justify-content-between">
      <h5>Quiz</h5>
      <button type="button" class="btn float-right btn-primary btn-sm" onclick="tambahKuis();" >Tambah Data</button>
    </div>

    <!-- <p>kosong (kondisi data kosong)</p> -->
    <div class="card mt-3">
      <div class="card-body ">
        <table class="table table-bordered table-striped" id="tabel-quiz">
          <thead>
            <tr>
              <th>Quiz</th>
              <th>Deadline</th>
              <th>Status </th>
              <th>Total soal </th>
              <th>aksi</th>
            </tr>
          </thead>
          <tbody>
            {{-- <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img src="{{url('elearning')}}/dist/img/quiz.jpg" alt="Product Image" width="30px">
                  <p class="mb-0 ml-3">Nama quiz</p>

                </div>
              </td>
              <td>
                <span>
                  <span>22/03/2021-00:00</span> | <span class="text-danger">24/03/2021-00:00</span>
                </span>
              </td>
              <td><span class="badge bg-warning">Loading</span></td>
              <td>20 soal</td>
              <td>
                <div class="btn-group ">
                  <a href="soal-quiz.html" type="button" class="btn btn-warning btn-sm">Lihat soal</a>
                  <a href="hasil-quiz.html" type="button" class="btn btn-success btn-sm">Lihat
                    hasil</a>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                    data-target="#modal-quiz">Edit</button>
                  <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <img src="{{url('elearning  ')}}/dist/img/quiz.jpg" alt="Product Image" width="30px">
                  <p class="mb-0 ml-3">Nama quiz</p>

                </div>
              </td>
              <td>
                <span>
                  <span>22/03/2021-00:00</span> | <span class="text-danger">24/03/2021-00:00</span>
                </span>
              </td>
              <td><span class="badge bg-success">Selesai</span></td>
              <td>20 soal</td>
              <td>
                <div class="btn-group ">
                  <a href="soal-quiz.html" type="button" class="btn btn-warning btn-sm">Lihat soal</a>
                  <a href="hasil-quiz.html" type="button" class="btn btn-success btn-sm">Lihat hasil</a>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                    data-target="#modal-quiz">Edit</button>
                  <button type="button" class="btn btn-danger btn-sm">Hapus</button>
                </div>
              </td>
            </tr> --}}

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>



  
  <div class="modal fade" id="modal-quiz">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="quiz-title">Tambah/edit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="form-quiz">
            <input type="hidden" id="kode_quiz" name="kode_quiz" >
            <input type="hidden" id="pertemuan_quiz" name="pertemuan_quiz" value="{{$pertemuan['id']}}" >
            <div class="form-group row">
              <label for="nama_kuis" class="col-sm-3 col-form-label">Nama kuis</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_kuis" name="nama_kuis" placeholder="">
              </div>
            </div>

            {{-- Mulai --}}
            <div class="form-group row">
              <label for="tanggal_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control datepicker" name="tanggal_mulai" id="tanggal_mulai" >
              </div>
            </div>
            <div class="form-group row">
              <label for="jam_mulai" class="col-sm-3 col-form-label">Jam Mulai</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="10:15" >
              </div>
            </div>
            {{-- selesai --}}
            <div class="form-group row">
              <label for="tanggal_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control datepicker" name="tanggal_selesai" id="tanggal_selesai" >
              </div>
            </div>
            <div class="form-group row">
              <label for="jam_selesai" class="col-sm-3 col-form-label">Jam Selesai</label>
              <div class="col-sm-9">
                  <input type="text" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="18:30" >
              </div>
            </div>

            <div class="form-group row">
              <label for="waktu" class="col-sm-3 col-form-label">Waktu (Menit)</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="waktu" name="waktu" placeholder="120">
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="simpan_quiz()">Simpan</button>
        </div>
      </div>
    </div>
  </div>

  
  <script>
   
    //  var pertemuan_id = ;
  
      function tambahKuis(){
          $('#modal-quiz').modal('show');
          $('#quiz-title').html('Tambah Kuis');
  
      }


      
  
    function simpan_quiz(){
          var formData = new FormData($('#form-quiz')[0])
          var form = $('#form-quiz');
              form.find('.invalid-feedback').remove();
              form.find('.form-control').removeClass('is-invalid');
         
          $.ajax({
              type: "POST",
              url: "{{ url('/quiz-dosen') }}",
              data: formData,
              contentType: false,
              cache:false,
              processData: false,
              dataType:"json",
              success: function(data) {
                  if (data.status == true) {
                      $('#modal-quiz').modal('hide');
                      $('#form-quiz').each(function() {
                              this.reset();
                          });
                      var table = $('#tabel-quiz').DataTable();
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
  
    function edit_quiz(id) {
        
          $('#quiz-title').html('Ubah Kuis');
          $('#kode_quiz').val(id);
        var form = $('#form-quiz');
        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $.get("{{ url('/quiz-dosen') }}" + '/' + id + '/edit', function (data) {
          $('#modal-quiz').modal('show');
            $('#nama_kuis').val(data.nama_kuis);
            $('#waktu').val(data.waktu);
            $('#tanggal_mulai').val(data.tanggal_mulai);
            $('#tanggal_selesai').val(data.tanggal_selesai);
            $('#jam_selesai').val(data.jam_selesai);
            $('#jam_mulai').val(data.jam_mulai);

        })
    }
  
  
    function hapus_quiz(id) {
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
                      url: "{{ url('quiz-dosen') }}" + '/' + id,
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
                          var table = $('#tabel-quiz').DataTable();
                          table.row(this).remove().draw(false);
                          
  
                      }
                  });
              }
  
  
          })
  
      }
  
   
  
    </script>