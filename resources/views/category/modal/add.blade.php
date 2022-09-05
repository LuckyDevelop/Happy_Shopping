<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAdd">
                @csrf
                <div class="modal-body">
                    <h6 class="font-weight-bold">Kategori <span class="text-danger">*</span></h6>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="category" name="category"
                            placeholder="Kategori">
                    </div>
                    <h6 class="font-weight-bold">Deskripsi</h6>
                    <div class="form-group">
                        <textarea class="form-control" id="description" name="description" style="height: 100px"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(('#formAdd')).submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('category_add_post') }}",
            type: "POST",
            data: $('#formAdd').serialize(),
            success: function(res) {
                toastr['success']("Data Kategori Berhasil ditambahkan!");
                window.setTimeout(function() {
                    window.location.reload();
                }, 1000);
            },
            error: function(res) {
                // $(".submit").prop('disabled', false);
                console.log(res);
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
