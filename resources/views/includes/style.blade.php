<meta name="viewport" content="width=device-width, initial-scale=1" />




<link rel="stylesheet" href="{{url('assets')}}/plugins/fontawesome-free/css/all.min.css" />
<link rel="stylesheet" href="{{url('assets')}}/dist/css/adminlte.min.css" />
<link rel="stylesheet" href="{{url('assets')}}/dist/css/style.css" />
<link rel="stylesheet" href="{{url('assets')}}/summernote/summernote-bs4.css">
{{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" /> --}}


<style>
    /* loading */
    .modal2 {
        display: none;
        position: fixed;
        z-index: 1050;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, .8) url('{{url('assets')}}/loading/loading.gif') 50% 50% no-repeat;
    }

    /* When the body has the loading class, we turn
                the scrollbar off with overflow:hidden */
    body.loading {
        overflow: hidden;
    }

    /* Anytime the body has the loading class, our
                modal element will be visible */
    body.loading .modal2 {
        display: block;
    }

</style>

<!-- jQuery -->
<script src="{{url('assets')}}/plugins/jquery/jquery.min.js"></script>


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="{{url('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{url('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
