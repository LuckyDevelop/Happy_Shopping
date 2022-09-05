<!DOCTYPE html>
<html lang="en">

<head>
    @include('common.header')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('common.side-menu')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('common.top-bar')
                <div id="content" class="scroll">
                    @if ($message = Session::get('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {!! $content !!}
                </div>
                @include('common.footer')
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        @include('modal.logout')
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
        <!-- Page level plugins -->
        <script type="text/javascript">
            function showError(data) {
                console.log(data);
                $('.invalid-feedback').remove();
                $.each(data, function(idx, item) {
                    $('#' + idx).addClass('is-invalid');
                    $('#' + idx).parent().append('<div class="invalid-feedback">' + item + '</div>')
                })
            }
            $('#sidebarToggleTop').click(function() {
                $(this).toggleClass("click");
                $('.sidebar').toggleClass("show");
                $('#content-wrapper').toggleClass("show-sidebar");
            });
        </script>
</body>

</html>
