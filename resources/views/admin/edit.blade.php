<div class="card mx-4">
    <div class="card-body">
        <h3 class="card-title font-weight-bold ml-3">Edit Admin</h3>
        <form id="formEdit">
            @csrf
            <div class="col-sm-6">
                <h6 class="font-weight-bold mt-3">Username <span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username"
                        value="{{ $admin->username }}">
                </div>
            </div>
            <div class="col-sm-6 mb-4">
                <p class="m-0">Peran</p>
                <select id="role" name="role" class="form-control">
                    @foreach ($role as $r)
                        <option value="{{ $r->id }}" @if ($admin->Role->id == $r->id) selected @endif>
                            {{ $r->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="ml-3">
                <x-button-back href="{{ route('account-list_view_index') }}" />
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('account-list_edit_changepassword', [$admin->id]) }}" class="btn btn-success">Ganti
                    Password</a>
            </div>
        </form>
    </div>
</div>
<script>
    $(('#formEdit')).submit(function(e) {
        $(".submit").prop('disabled', true);
        e.preventDefault();
        $.ajax({
            url: "{{ route('account-list_edit_patch') }}",
            type: "PATCH",
            data: $('#formEdit').serialize(),
            success: function(res) {
                toastr['success']("Admin Berhasil diubah!");
                window.setTimeout(function() {
                    window.location.href = "{{ route('account-list_view_index') }}";
                }, 1000);
            },
            error: function(res) {
                $(".submit").prop('disabled', false);
                if (res.status != 422)
                    toastr['error']("Something went wrong");
                showError(res.responseJSON.errors, "#formEdit");
                $.each(res.responseJSON.errors, function(idx, item) {
                    toastr['error'](idx = item);
                });
            }
        });
        return false;
    });
</script>
