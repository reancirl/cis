<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script type="text/javascript">
    var success = "{{ Session::get('success') }}";
    if (success) {
        swal ({
            text: success,
            icon: 'success',
            button: 'OK',
        });
    }

    var deleted = "{{ Session::get('deleted') }}";
    if (deleted) {
        swal ({
            text: deleted,
            icon: 'error',
            button: 'OK',
        });
    }

    var error = "{{ Session::get('error') }}";
    if (error) {
        swal ({
            text: error,
            icon: 'error',
            button: 'OK',
        });
    }

    var warning = "{{ Session::get('warning') }}";
    if (warning) {
        swal ({
            text: warning,
            icon: 'info',
            button: 'OK',
        });
    }

    var errors = $('.alert-errors').length;
    var html_errors = $('#html_errors').val();
    if(errors){
        swal ({
            text: html_errors,
            icon: 'error',
            button: 'OK',
        });
    }
</script>
@yield('third_party_scripts')
@stack('page_scripts')