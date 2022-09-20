<div class="card mx-4">
    <div class="card-body">
        <h3 class="card-title font-weight-bold ml-3">Edit Transaksi</h3>
        <form id="formEdit">
            @csrf
            <div class="col-sm-6">
                <div class="form-group">
                    <label id="name">Kategori Produk <span class="text-danger">*</span></label>
                    <select onchange="" class="form-control select2-category" style="width: 100%" id="category"
                        name="category">
                    </select>
                </div>

                <h6 class="font-weight-bold mt-3">Nama Produk <span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="product_name" name="product_name"
                        placeholder="Nama Produk" value="{{ $product->name }}">
                    <input type="hidden" name="id" value="{{ $product->id }}">
                </div>

                <h6 class="font-weight-bold mt-3">Harga Beli<span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="purchase_price_edit"
                        name="purchase_price" value="{{ number_format($product->purchase_price, 0, '.', '.') }}">
                </div>

                <h6 class="font-weight-bold mt-3">Harga Jual<span class="text-danger">*</span></h6>
                <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="price_edit" name="price"
                        value="{{ number_format($product->price, 0, '.', '.') }}">
                </div>

                <div class="col mb-3">
                    <div class="form-check form-check-inline">
                        @if ($product->new_product == 1)
                            <input class="form-check-input" type="checkbox" value="1" id="new_product"
                                name="new_product" checked>
                            <label class="form-check-label" for="new_product">
                                New Product
                            </label>
                        @else
                            <input class="form-check-input" type="checkbox" value="1" id="new_product"
                                name="new_product">
                            <label class="form-check-label" for="new_product">
                                New Product
                            </label>
                        @endif
                    </div>
                    <div class="form-check form-check-inline">
                        @if ($product->best_seller == 1)
                            <input class="form-check-input" type="checkbox" value="1" id="best_seller"
                                name="best_seller" checked>
                            <label class="form-check-label" for="best_seller">
                                Best Seller
                            </label>
                        @else
                            <input class="form-check-input" type="checkbox" value="1" id="best_seller"
                                name="best_seller">
                            <label class="form-check-label" for="best_seller">
                                Best Seller
                            </label>
                        @endif
                    </div>
                    <div class="form-check form-check-inline">
                        @if ($product->featured == 1)
                            <input class="form-check-input" type="checkbox" value="1" id="featured"
                                name="featured" checked>
                            <label class="form-check-label" for="featured">
                                Featured
                            </label>
                        @else
                            <input class="form-check-input" type="checkbox" value="1" id="featured"
                                name="featured">
                            <label class="form-check-label" for="featured">
                                Featured
                            </label>
                        @endif
                    </div>
                </div>
                <div class="col-sm mb-3">
                    @if ($product->status == 1)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status" name="status" value="1"
                                checked>
                            <label class="form-check-label" for="status">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status" name="status"
                                value="0">
                            <label class="form-check-label" for="status">
                                Tidak aktif
                            </label>
                        </div>
                    @else
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status" name="status"
                                value="1">
                            <label class="form-check-label" for="status">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="status" name="status"
                                value="0" checked>
                            <label class="form-check-label" for="status">
                                Tidak aktif
                            </label>
                        </div>
                    @endif
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
            <div class="ml-3">
                <a href="{{ route('product') }}" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    $(('#formEdit')).submit(function(e) {
        e.preventDefault();
        unsetFormat();
        $.ajax({
            url: "{{ route('product_edit_patch') }}",
            type: "PATCH",
            data: $('#formEdit').serialize(),
            success: function(res) {
                toastr['success']("Produk Berhasil diubah!");
                window.setTimeout(function() {
                    window.location.href = "{{ route('product_view_index') }}";
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

    $(document).ready(function(e) {
        var option = new Option("{{ $product->ProductCategory->category }}",
            "{{ $product->ProductCategory->id }}", true, true);
        $(".select2-category").append(option).trigger("change");

        $(".select2-category").trigger({
            type: "select2:select",
            params: {
                data: {
                    id: "{{ $product->ProductCategory->id }}",
                    text: "{{ $product->ProductCategory->category }}",
                    is_init: true
                }
            }
        });
    });

    $('.select2-category').select2({
        ajax: {
            url: "{{ url('/product-category/auto') }}",
            dataType: 'json',
            processResults: function(data, params) {
                console.log(data);
                return {
                    results: data
                };
            }
        },
        placeholder: 'Cari Kategori Produk',
        templateResult: formatRepo,
        templateSelection: formatRepoSelection,
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

    $('#purchase_price_edit').keyup(function(e) {
        $(this).val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });
    $('#price_edit').keyup(function(e) {
        $(this).val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });

    function unsetFormat() {
        $("#purchase_price_edit").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        $("#price_edit").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
    }
</script>
