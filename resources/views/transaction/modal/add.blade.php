<!-- Modal -->
<div class="modal fade" id="addModal" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAdd">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <!--col 1-->
                        <div class="col-sm">
                            <div class="form-group">
                                <h4 class="font-weight-bold">Detail Pelanggan</h4>
                                <h6 class="font-weight-bold mt-3">Nama Pelanggan <span class="text-danger">*</span></h6>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="customer"
                                        name="customer" placeholder="Masukkan Nama Pelanggan">
                                </div>
                            </div>

                            <div class="form-group">
                                <h6 class="font-weight-bold mt-3">Email Pelanggan <span class="text-danger">*</span>
                                </h6>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        name="email" placeholder="Masukkan Email Pelanggan">
                                </div>
                            </div>

                            <div class="form-group">
                                <h6 class="font-weight-bold mt-3">No. HP Pelanggan <span class="text-danger">*</span>
                                </h6>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="phone"
                                        name="phone" placeholder="Masukkan Nomor Telepon Pelanggan">
                                </div>
                            </div>
                        </div>
                        <!--col 2-->
                        <div class="col-sm">
                            <h4 class="font-weight-bold">Detail Produk</h4>
                            <div class="form-group">
                                <label id="name" class="font-weight-bold">Nama Produk <span
                                        class="text-danger">*</span></label>
                                <select onchange="" class="form-control select2-name" style="width: 100%"
                                    id="product" name="product">
                                </select>
                            </div>

                            <div class="form-group">
                                <h6 class="font-weight-bold mt-3">Harga Satuan Produk <span class="text-danger">*</span>
                                </h6>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="price"
                                        name="price" placeholder="Pilih Produk Terlebih Dahulu" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <h6 class="font-weight-bold mt-3">Jumlah Produk <span class="text-danger">*</span></h6>
                                <div class="form-group">
                                    <input type="text" onkeyup="setSubTotal()" class="form-control form-control-user"
                                        id="qty" name="qty" placeholder="Masukkan Jumlah Produk">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm">
                                    <label id="name" class="font-weight-bold">Voucher</label>
                                    <select onchange="" class="form-control select2-voucher" style="width: 100%"
                                        id="voucher" name="voucher">
                                    </select>
                                    <input type="hidden" id="type" value="0">
                                    <input type="hidden" id="disc_value" value="0">
                                </div>
                                <div class="col-sm-3 mt-4">
                                    <a href="javascript:void(0)" class="btn btn-outline-primary form-control"
                                        onclick="setVoucher()">Apply</a>
                                </div>
                                <div class="col-sm-3 mt-4">
                                    <a href="javascript:void(0)" class="btn btn-outline-danger form-control"
                                        onclick="deleteVoucher()">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- baris 2 -->
                    <div class="row">
                        <h5 class="font-weight-bold">Detail Transaksi</h5>
                        <div id="data-transaksi" style="height: 90px">
                            <table>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>: Rp</td>
                                    <td id="subtotal">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Potongan/Diskon</td>
                                    <td>: Rp</td>
                                    <td id="diskon">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>: Rp</td>
                                    <td id="total">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <h6 class="font-weight-bold">Permintaan Tambahan</h6>
                    <div class="form-group">
                        <textarea class="form-control" id="additional_request" name="additional_request" style="height: 100px"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                <input type="hidden" id="sub" value="0">
                <input type="hidden" id="disc" value="0">
                <input type="hidden" id="tot" value="0">
            </form>
        </div>
    </div>
</div>
<script>
    function deleteVoucher() {
        var sub = $('#sub').val();
        $('#diskon').html('');
        $('#disc').val(0);
        $('#tot').val(sub);
        var sum = $('#sub').val();
        var output = sum.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $('#total').html(output);
    }

    function setVoucher() {
        if ($('#type').val() == 1) {
            changeFormat();
            var diskon = $('#disc_value').val();
            $('#diskon').html(diskon);

            var diskon = diskon.replaceAll('.', '');
            $('#disc').val(diskon);

            var sum = $('#sub').val() - diskon;
            $('#tot').val(sum);
            var output = sum.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            $('#total').html(output);
        } else {
            var diskon = $('#disc_value').val();
            var totdiskon = $('#sub').val() * diskon;
            var output = totdiskon.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            $('#diskon').html(output);

            $('#disc').val(totdiskon);

            var sum = $('#sub').val() - totdiskon;
            $('#tot').val(sum);
            var output = sum.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            $('#total').html(output);
        }
        $("#voucher option[value!='']").remove();
    }

    function setSubTotal() {
        $("#price").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        var price = $('#price').val();
        var qty = $('#qty').val();
        var disc = $('#disc').val();

        var sum = price * qty - disc;
        var output = sum.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

        $('#subtotal').html(output);
        $('#sub').val(sum);
        var sumtot = sum - $('#disc').val();
        var output = sumtot.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $('#total').html(output);

        $('#tot').val(sumtot);
    }

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
        // dropdownParent: $('#addModal');
        ajax: {
            url: "{{ url('/product/auto') }}",
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
        $('#price').val(repo.price);
        if (repo.name != undefined) {
            return repo.name;
        } else {
            return repo.text;
        }
    }

    $('.select2-voucher').select2({
        // dropdownParent: $('#addModal');
        ajax: {
            url: "{{ url('/voucher/auto') }}",
            dataType: 'json',
            processResults: function(data, params) {
                return {
                    results: data
                };
            }
        },
        placeholder: 'Masukkan Kode Voucher',
        templateResult: formatRepoVoucher,
        templateSelection: formatRepoSelectionVoucher
    });

    function formatRepoVoucher(repo) {
        if (repo.loading) {
            return repo.text;
        }
        if (repo.tipe == 2) {
            var $container = $("<div class='select2-result-repository clearfix'>" + repo.name + ' - ' + repo.sum + '%' +
                "</div>");
        } else {
            var $container = $("<div class='select2-result-repository clearfix'>" + repo.name + ' - ' + 'Rp' + repo
                .sum +
                "</div>");
        }

        return $container;
    }

    function formatRepoSelectionVoucher(repo) {
        $('#disc_value').val(repo.diskon);
        $('#type').val(repo.tipe);
        if (repo.name != undefined) {
            return repo.name;
        } else {
            return repo.text;
        }
    }

    function changeFormat() {
        $("#disc_value").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    }

    function unchangeFormat() {
        $("#disc_value").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
    }
</script>
