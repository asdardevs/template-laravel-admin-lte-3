@extends('layouts.app')

@section('title')
Profil
@endsection

@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                
                <img class="profile-user-img img-fluid img-circle" src="{{url('profile')}}/{{Auth::user()->profil}}"
                  alt="User profile picture">
              </div>
              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
              <p class="text-muted text-center">Dosen</p>
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Total kelas</b> <a class="float-right"><span>@php
                      echo DB::table('classrooms')->where('dosen_id', Auth::user()->id)->count();
                  @endphp</span> Kelas</a>
                </li>
                <li class="list-group-item">
                  <b>Total mahasiswa</b> <a class="float-right"><span>
                    @php
                    echo DB::table('students')->where('dosen_id', Auth::user()->id)->count();
                @endphp      
                </span> Orang</a>
                </li>
              </ul>
              <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#input"><b>Edit
                  profil</b></button>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>



<div class="modal fade" id="input">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="status">Update Foto Profil</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form id="form">
              <label for="exampleInputEmail1">Foto profil</label>
              <div class="form-group">
                <div class="custom-file">
                  <input type="file" class="form-control custom-file-input" id="file" name="file" >
                  <label class="custom-file-label" for="file">Chose file</label>
                  <small class="text-danger" >*Kosongkan jika tidak..</small>
                </div>
              </div>
              <div class="form-group">
                <label for="password">Password lama</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              </div>
              <div class="form-group">
                <label for="password_confirmation">Password Baru</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password Baru">
              </div>
            </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-sm btn-primary" onclick="simpan();" >Simpan</button>

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
      
      

    });
   function simpan(){
        var file = document.getElementById("file").files[0];
            var formData = new FormData($('#form')[0]);
                formData.append("file", file);
            var form = $('#form');
                form.find('.invalid-feedback').remove();
                form.find('.form-control').removeClass('is-invalid');

            $.ajax({
                type: "POST",
                url: "{{ url('/profil') }}",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                      Swal.fire({
                        title: 'Berhasil',
                        text: "Berhasil update profil",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.reload();
                        }
                      })
  
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
        }


      $('.custom-file-input').on('change', function () {
          let fileName = $(this).val().split('\\').pop();
          $(this).next('.custom-file-label').addClass("selected").html(fileName);
      }); 
    </script>  
@endpush


