@extends('layouts.app')

@section('title')
Pertemuan kuliah
@endsection

@section('content')


<section class="content">
    <div class="container-fluid">
      <div class="card">
        <!-- header card -->
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-chalkboard-teacher"></i>
            {{$pertemuan->nama}} <span>|   {{$pertemuan->kelas->nama}}</span>
          </h3>
        </div>
        <!-- end header card -->

        <!--card body -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">

              <!-- card modul -->
              @include('dosen.pertemuan.modul')
             
              <!-- end card modul -->

              <!-- card tugas -->
              @include('dosen.pertemuan.task')
              <!-- end card tugas -->

              <!-- card quiz -->
               @include('dosen.pertemuan.quiz')
              
            
              <!-- end card quiz -->

              <!--card diskusi (chat maahsiswa dan dosen)  -->
          
              <div class="row">
                <div class="col-md-6">
                     @include('dosen.pertemuan.chat')
                </div>
              </div>
              <!-- end card chat -->


            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
  </section>

@endsection



@push('addon-script')

<script>

var pertemuan_id = "{{$pertemuan['id']}}";

   $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      
        get_modul("{{$pertemuan['id']}}");
        get_chat();


      // Tabel task => tugas
        var table = $('#tabel-task').DataTable({
            processing: true,
            serverSide: true,
            paging:   false,
            ordering: false,
            info:     false,
            searching: false,
            ajax: "{{ url('/task') }}" + '/' + pertemuan_id ,
            columns: [
                // {
                //     data: 'DT_RowIndex',
                //     name: 'DT_RowIndex'
                // },
                {
                    data: 'tugas',
                    name: 'tugas'
                },
                {
                    data: 'deadline',
                    name: 'deadline'
                },
                {
                    data: 'status',
                    name: 'status'
                },
           
              
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
              
                
            ]
        });

        var table = $('#tabel-quiz').DataTable({
            processing: true,
            serverSide: true,
            paging:   false,
            ordering: false,
            info:     false,
            searching: false,
            ajax: "{{ url('/quiz') }}" + '/' + pertemuan_id ,
            columns: [
                // {
                //     data: 'DT_RowIndex',
                //     name: 'DT_RowIndex'
                // },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'deadline',
                    name: 'deadline'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'total',
                    name: 'total'
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




  function get_modul(id){
    $.get("{{ url('/modul') }}" + '/' + id , function (data) {
            if (data.length > 0) {
              var html = '';
              data.forEach((key, value) => {
               html += ` 
               <div class="btn-group mt-3">
                    <a target="_blank" href="{{url('pertemuan')}}/${key.file}" type="button" class="btn btn-default btn-sm"><i
                          class="fas fa-book mr-2 text-danger"></i>${key.nama}</a>
                   
                    <button type="button" onclick="hapus_modul(${key.id})" class="btn btn-secondary btn-sm">Hapus</button>
                    </div>
                         
                          ` ; 
                          });

              $('#show-modul').html(html);
            } else{
              $('#show-modul').html(`<p>Data Modul Kosong </p>`);
            }
        })

  };




    





  function get_chat(){
   
    $.get("{{ url('/diskusi') }}" + '/' + pertemuan_id , function (data) {

           
              var html = '';
              data.forEach((key, value) => {
                
                if (key.user_id != "{{Auth::user()->id}}") {
                   html +=`  <div class="direct-chat-msg">
                          <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name float-left"> ${key.user.name}</span>
                            <span class="direct-chat-timestamp float-right">${key.created_at}</span>
                          </div>
                          <img class="direct-chat-img" src="{{url('profile')}}/${key.user.profil}" alt="message user image">
                          <div class="direct-chat-text">
                            ${key.komentar}
                          </div>
                        </div> `;
                } else if(key.user_id == "{{Auth::user()->id}}" ) {
                  html +=`  <div class="direct-chat-msg right">
                            <div class="direct-chat-infos clearfix">
                              <span class="direct-chat-name float-right"> ${key.user.name}</span>
                              <span class="direct-chat-timestamp float-left">${key.created_at}</span>
                            </div>
                            <img class="direct-chat-img" src="{{url('profile')}}/${key.user.profil}" alt="message user image">
                            <div class="direct-chat-text">
                              ${key.komentar}
                            </div>
                          </div> `;
                } else{
                  html += `Kosong` ; 
                }
           });

              $('#show-chat').html(html);
           
        })

  };





  $(".datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: new Date()
    });

  $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        }); 
  setInterval(get_chat, 1000);
</script>
    
@endpush


