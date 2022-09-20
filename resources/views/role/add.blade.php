<div class="card mx-4">
    <div class="card-body">
        <h3 class="card-title font-weight-bold ml-3">Tambah Peran</h3>
        <form id="formAdd">
            @csrf
            <div class="col-sm-6">
                <h6 class="font-weight-bold mt-3">Peran <span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="role" name="role"
                        placeholder="Nama Produk" value="">
                </div>
            </div>
            <div class="ml-3">
                <x-button-back href="{{ route('role_view_index') }}" />
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(('#formAdd')).submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('role_add_post') }}",
            type: "POST",
            data: $('#formAdd').serialize(),
            success: function(res) {
                toastr['success']("Peran Berhasil ditambahkan!");
                window.setTimeout(function() {
                    window.location.href = "{{ route('role_view_index') }}";
                }, 1000);
            },
            error: function(res) {
                // $(".submit").prop('disabled', false);
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
