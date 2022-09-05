<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAdd">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label id="name">Kategori Produk <span class="text-danger">*</span></label>
                        <select onchange="" class="form-control select2-name" style="width: 100%" id="category"
                            name="category">
                        </select>
                    </div>

                    <h6 class="font-weight-bold mt-3">Nama Produk <span class="text-danger">*</span></h6>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="product_name"
                            name="product_name" placeholder="Nama Produk">
                    </div>

                    <h6 class="font-weight-bold mt-3">Harga Jual<span class="text-danger">*</span></h6>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="price" name="price">
                    </div>

                    <h6 class="font-weight-bold mt-3">Harga Beli<span class="text-danger">*</span></h6>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="purchase_price"
                            name="purchase_price">
                    </div>
                    <div class="col mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" id="new_product"
                                name="new_product" checked>
                            <label class="form-check-label" for="new_product">
                                New Product
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" id="best_seller"
                                name="best_seller">
                            <label class="form-check-label" for="best_seller">
                                Best Seller
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="1" id="featured"
                                name="featured">
                            <label class="form-check-label" for="featured">
                                Featured
                            </label>
                        </div>
                    </div>
                    <div class="col-sm mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status" name="status" value="1"
                                checked>
                            <label class="form-check-label" for="status">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status" name="status" value="0">
                            <label class="form-check-label" for="status">
                                Tidak aktif
                            </label>
                        </div>
                    </div>

                    <h6 class="font-weight-bold">Short Deskripsi</h6>
                    <div class="form-group">
                        <textarea class="form-control" id="short_description" name="short_description" style="height: 100px"></textarea>
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
            url: "{{ route('product_add_post') }}",
            type: "POST",
            data: $('#formAdd').serialize(),
            success: function(res) {
                toastr['success']("Produk Berhasil ditambahkan!");
                window.setTimeout(function() {
                    window.location.reload();
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

    $('.select2-name').select2({
        ajax: {
            url: "{{ url('/product-category/auto') }}",
            dataType: 'json',
            processResults: function(data, params) {
                return {
                    results: data
                };
            }
        },
        placeholder: 'Cari Kategori Produk',
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(repo) {
        if (repo.loading) {
            return repo.text;
        }
        var $container = $("<div class='select2-result-repository clearfix'>" + repo.name + "</div>");

        return $container;
    }

    function formatRepoSelection(repo) {
        if (repo.name != undefined) {
            return repo.name;
        } else {
            return repo.text;
        }
    }
</script>
