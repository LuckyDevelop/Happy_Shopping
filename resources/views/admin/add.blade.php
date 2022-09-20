<div class="card mx-4">
    <div class="card-body">
        <h3 class="card-title font-weight-bold ml-3">Tambah Admin</h3>
        <form id="formAdd">
            @csrf
            <div class="col-sm-6">
                <h6 class="font-weight-bold mt-3">Username <span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username" name="username"
                        value="">
                </div>
            </div>
            <div class="col-sm-6">
                <h6 class="font-weight-bold mt-3">Password <span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" name="password"
                        value="">
                </div>
            </div>
            <div class="col-sm-6 mb-4">
                <p class="m-0">Peran</p>
                <select id="role" name="role" class="form-control">
                    @foreach ($role as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
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
            url: "{{ route('account-list_add_post') }}",
            type: "POST",
            data: $('#formAdd').serialize(),
            success: function(res) {
                toastr['success']("Admin Berhasil ditambahkan!");
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
