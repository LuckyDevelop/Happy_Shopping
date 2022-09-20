<div class="card mx-4">
    <div class="card-body">
        <h3 class="card-title font-weight-bold ml-3">Edit Transaksi</h3>
        <form id="formEdit">
            @csrf
            <div class="col-sm-6">
                <h6 class="font-weight-bold mt-3">Peran <span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="role" name="role"
                        placeholder="Nama Produk" value="{{ $role->name }}">
                    <input type="hidden" name="id" value="{{ $role->id }}">
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
    $(('#formEdit')).submit(function(e) {
        $(".submit").prop('disabled', true);
        e.preventDefault();
        $.ajax({
            url: "{{ route('role_edit_patch') }}",
            type: "PATCH",
            data: $('#formEdit').serialize(),
            success: function(res) {
                toastr['success']("Peran Berhasil diubah!");
                window.setTimeout(function() {
                    window.location.href = "{{ route('role_view_index') }}";
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
