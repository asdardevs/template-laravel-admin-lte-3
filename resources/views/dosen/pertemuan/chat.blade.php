<div class="card direct-chat direct-chat-primary">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
      <h3 class="card-title">Diskusi</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <!-- Conversations are loaded here -->
      <div class="direct-chat-messages" id="show-chat">

     

      </div>
      <!--/.direct-chat-messages-->
      <!-- /.card-body -->
      <div class="card-footer">
        <form  id="form-chat">
          <div class="input-group">
            <input type="text" name="message" id="message" placeholder="Type Message ..." class="form-control">
            <span class="input-group-append">
              <button type="button" class="btn btn-primary" onclick="send_chat();">Send</button>
            </span>
          </div>
        </form>
      </div>
      <!-- /.card-footer-->
    </div>
  </div>


  <script>
      function send_chat(){
        var message = $('#message').val();
        var pertemuan_id = "{{$pertemuan['id']}}";
        $.ajax({
                type: "POST",
                dataType: "json",
                data: ({
                  message,
                  pertemuan_id
                   
                }),
                url: "{{url('simpan-chat')}}",
                success: function (data) {
                   $('#form-chat').each(function() {
                            this.reset();
                        });
                  get_chat();
                 
                }
            })
      }
  </script>