<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Happy Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.css" rel="stylesheet" media="all">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>
</head>

<body>
    <div class="card mb-3 mx-auto rounded" style="max-width: 800px; margin-top:10%">
        <div class="row g-0">
            <div class="col-md-7" style="background-color: #33ccff">
                <img src="{{ asset('images/login.png') }}" class="img-fluid rounded-start" alt="login.jpg">
            </div>
            <div class="col-md">
                <div class="card-body text-center">
                    <form id="formLogin">
                        @csrf
                        <h4 class="card-title">Sign-in</h4>
                        <div class="container mt-5">
                            <div class="row">
                                <label for="username" class="form-label h5">Username</label>
                                <input type="text" class="form-control mb-3" id="username" name="username">

                                <label for="password" class="form-label h5">Password</label>
                                <input type="password" class="form-control mb-3" id="password" name="password">

                                <input class="btn btn-primary" type="submit" value="Submit">
                                <span>Not have account?<a href="{{ route('sign-up') }}">Register Here!</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    $('#formLogin').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('login_process') }}",
            type: "POST",
            data: $('#formLogin').serialize(),
            success: function(res) {
                if (res.status == true) {
                    toastr['success'](res.success);
                    window.location.reload();
                } else {
                    toastr['error'](res.error);
                }
            },
            error: function(res) {
                toastr['error'](res);
            }
        });
        return false;
    });

    function showError(data) {
        console.log(data);
        $('.invalid-feedback').remove();
        $.each(data, function(idx, item) {
            $('#' + idx).addClass('is-invalid');
            $('#' + idx).parent().append('<div class="invalid-feedback">' + item + '</div>')
        })
    }
</script>
