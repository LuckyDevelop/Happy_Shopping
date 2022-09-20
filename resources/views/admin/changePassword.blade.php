<div class="card mx-4">
    <div class="card-body">
        <h3 class="card-title font-weight-bold ml-3">Ganti Password</h3>
        <form id="formAdd">
            @csrf
            <div class="col-sm-6">
                <h6 class="font-weight-bold mt-3">Password <span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password"
                        value="">
                </div>
            </div>
            <div class="ml-3">
                <x-button-back href="{{ route('account-list_view_index') }}" />
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(('#formAdd')).submit(function(e) {
        $(".submit").prop('disabled', true);
        e.preventDefault();
        $.ajax({
            url: "{{ route('account-list_edit_patch_pass', $admin->id) }}",
            type: "PATCH",
            data: $('#formAdd').serialize(),
            success: function(res) {
                toastr['success']("Password Berhasil diubah!");
                window.setTimeout(function() {
                    window.location.href = "{{ route('account-list_view_index') }}";
                }, 1000);
            },
            error: function(res) {
                $(".submit").prop('disabled', false);
                if (res.status != 422)
                    toastr['error']("Something went wrong");
                showError(res.responseJSON.errors, "#formAdd");
                $.each(res.responseJSON.errors, function(idx, item) {
                    toastr['error'](idx = item);
                });
            }
        });
        return false;
    });
</script>
