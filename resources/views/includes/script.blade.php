<!-- Bootstrap 4 -->
<script src="{{url('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('assets')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('assets')}}/dist/js/demo.js"></script>

<!-- DataTables -->
<script src="{{url('assets')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{url('assets')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{url('assets')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('assets')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Toastr -->
<script src="{{url('assets')}}/plugins/toastr/toastr.min.js"></script>


<script type="text/javascript" src="{{url('assets')}}/sweetalert2/dist/sweetalert2.all.min.js"></script>

{{-- <script src="{{url('assets')}}/summernote/summernote-bs4.min.js"></script> --}}




<!-- Your custom scripts (optional) -->
<script type="text/javascript">
    // $body = $("body");
    // $(document).on({
    //     ajaxStart: function () {
    //         $body.addClass("loading");

    //     },
    //     ajaxStop: function () {
    //         $body.removeClass("loading");
    //     }

    // });



    function logout() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('logout') }}",
                        success: function (data) {
                            location.href = "{{url('/')}}";
                        }


                    });
                }
            }


        })

    }

</script>
