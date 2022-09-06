<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="editLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLabel">Edit Kategori Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <h6 class="font-weight-bold">Kategori <span class="text-danger">*</span></h6>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="category" name="category"
                            value="{{ $category->category }}">
                    </div>
                    <h6 class="font-weight-bold">Deskripsi</h6>
                    <div class="form-group">
                        <textarea class="form-control" id="description" name="description" style="height: 100px">{{ $category->description }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(('#formEdit')).submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: `{{ route('category_edit_patch') }}`,
            type: "PATCH",
            data: $('#formEdit').serialize(),
            success: function(res) {
                toastr['success']("Data Kategori Berhasil diubah!");
                window.setTimeout(function() {
                    window.location.reload();
                }, 1000);
            },
            error: function(res) {
                // $(".submit").prop('disabled', false);
                console.log(res);
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
