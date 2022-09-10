<div class="card mx-4">
    <div class="card-body">
        <h3 class="card-title font-weight-bold ml-3">Edit Transaksi</h3>
        <form id="formEdit">
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
                                    name="customer" placeholder="Masukkan Nama Pelanggan"
                                    value="{{ $transaction->customer_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 class="font-weight-bold mt-3">Email Pelanggan <span class="text-danger">*</span>
                            </h6>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email"
                                    name="email" placeholder="Masukkan Email Pelanggan"
                                    value="{{ $transaction->customer_email }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <h6 class="font-weight-bold mt-3">No. HP Pelanggan <span class="text-danger">*</span>
                            </h6>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="phone"
                                    name="phone" placeholder="Masukkan Nomor Telepon Pelanggan"
                                    value="{{ $transaction->customer_phone }}">
                            </div>
                        </div>
                    </div>
                    <!--col 2-->
                    <div class="col-sm">
                        <h4 class="font-weight-bold">Detail Produk</h4>
                        <div class="form-group">
                            <label id="name" class="font-weight-bold">Nama Produk</label>
                            <select onchange="" class="form-control select2-name" style="width: 100%" id="product"
                                name="product">
                            </select>
                            <input type="hidden" id="product_name" name="product_name">
                        </div>

                        <div class="form-group">
                            <h6 class="font-weight-bold mt-3">Harga Produk
                            </h6>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="price"
                                    name="price" placeholder="Pilih Produk Terlebih Dahulu" readonly>
                            </div>
                            <input type="hidden" id="purchase_price" name="purchase_price" value="0">
                        </div>

                        <div class="form-group">
                            <h6 class="font-weight-bold mt-3">Jumlah Produk</h6>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="qty"
                                    name="qty" value="" placeholder="Masukkan Jumlah Produk">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" onclick="getProduct()">Tambah
                                Produk</button>
                        </div>
                    </div>
                </div>
                <!-- baris 2 -->
                <div class="row">
                    <h5 class="font-weight-bold">Detail Transaksi <span class="text-danger">*</span></h5>
                    <div class="row mb-3">
                        <div class="table-responsive-md" style="width: 100%">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="productList">
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($transaction->TransactionDetail as $d)
                                        <x-table-row>
                                            <td class="table-light">
                                                {{ $d->Product->name }}
                                                <input type="hidden" name="product_id[{{ $i }}]"
                                                    value="{{ $d->Product->id }}">
                                            </td>
                                            <td class="table-light">
                                                {{ $d->qty }}
                                                <input type="hidden" name="qty_product[{{ $i }}]"
                                                    value="{{ $d->qty }}">
                                            </td>
                                            <td class="table-light">
                                                Rp {{ number_format($d->price_satuan, 0, '.', '.') }}
                                                <input type="hidden" name="price_product[{{ $i }}]"
                                                    value="{{ $d->price_satuan }}">
                                                <input type="hidden" name="purchase_price_product[]"
                                                    id="purchase_price_product" value="{{ $d->price_purchase_total }}">
                                            </td>
                                            <td class="table-light">
                                                Rp {{ number_format($d->price_total, 0, '.', '.') }}
                                                <input type="hidden" name="total[{{ $i }}]"
                                                    id="total_price" value="{{ $d->price_total }}">
                                            </td>
                                            <td class="table-light">
                                                <x-button-delete-table onclick="removeProduct(this)" />
                                            </td>
                                        </x-table-row>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <h5 id="name" class="font-weight-bold">Voucher</h5>
                            <select onchange="" class="form-control select2-voucher" style="width: 100%"
                                id="voucher" name="voucher">
                            </select>
                            <input type="hidden" id="type" value="0">
                            <input type="hidden" id="disc_value" value="0">
                        </div>
                        <div class="col-sm-2 mt-4">
                            <a href="javascript:void(0)" class="btn btn-outline-primary form-control" id="apply"
                                onclick="setVoucher()">Apply</a>
                        </div>
                        <div class="col-sm-2 mt-4">
                            <a href="javascript:void(0)" class="btn btn-outline-danger form-control" id="delete"
                                onclick="deleteVoucher()">Delete</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div id="data-transaksi" class="col-sm" style="height: 100%">
                            <table>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>: Rp</td>
                                    <td>
                                        <input type="text" class="form-control" name="subtotal" id="subtotal"
                                            value="{{ number_format($transaction->sub_total, 0, '.', '.') }}"
                                            readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Potongan/Diskon</td>
                                    <td>: Rp</td>
                                    <td>
                                        <input type="text" class="form-control" name="discount"
                                            value="{{ number_format($transaction->sub_total - $transaction->total, 0, '.', '.') }}"
                                            id="diskon" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>: Rp</td>
                                    <td>
                                        <input type="text" class="form-control" name="totalall"
                                            value="{{ number_format($transaction->total, 0, '.', '.') }}"
                                            id="total" readonly>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" id="purchase" name="purchase" value="0">
                        </div>
                        <div class="col-sm mb-3">
                            <h5 class="font-weight-bold">Metode Pembayaran <span class="text-danger">*</span></h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault1"
                                    value="Cash" @if ($transaction->payment_method == 'Cash') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <i class="fas fa-fw fa-money-bill-wave"></i> Cash
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="flexRadioDefault2"
                                    value="Kartu Debit/Kredit" @if ($transaction->payment_method == 'Kartu Debit/Kredit') checked @endif>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    <i class="fas fa-fw fa-credit-card"></i> Kartu Debit/Kredit
                                </label>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm">
                                    <h5 class="font-weight-bold">Status</h5>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="paid"
                                            value="2" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Done/Paid
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Permintaan Tambahan</h6>
                <div class="form-group">
                    <textarea class="form-control" id="additional_request" name="additional_request" style="height: 100px">{{ $transaction->additional_request }}</textarea>
                </div>
            </div>
            <div class="text-left">
                <a href="{{ route('transaction') }}" class="btn btn-danger btn-icon-split">
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
    $(document).ready(function(e) {
        var option = new Option("{{ $voucher[0]->Voucher->code }}",
            "{{ $voucher[0]->Voucher->id }}", true,
            true);
        $(".select2-voucher").append(option).trigger("change");

        $(".select2-voucher").trigger({
            type: "select2:select",
            params: {
                data: {
                    id: "{{ $voucher[0]->Voucher->id }}",
                    label: "{{ $voucher[0]->Voucher->code }}",
                    is_init: true
                }
            }
        });
    })

    function getProduct() {
        $("#price").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        $('#qty').val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        let formData = $('#formEdit').serialize();
        $.ajax({
            url: `/transaction/insert_product`,
            method: 'GET',
            data: formData,
            success: function(data) {
                $('#productList').append(data);
                $("#product option[value!='']").remove();
                $('#product_name').val("");
                $('#price').val("");
                $('#qty').val("");
                $('.invalid-feedback').remove();
                getSubTotal();
            },
            error: function(error) {
                $("#price").val(function(index, value) {
                    return value
                        .replace(/^0+/, '')
                        .replace(/\D/g, "")
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                });
                if (error.status != 422)
                    toastr['error']("Something went wrong");
                showError(error.responseJSON.errors, "#formEdit");
                $.each(error.responseJSON.errors, function(idx, item) {
                    toastr['error'](idx = item);
                });
            }
        })
    }

    function getSubTotal() {
        var sum = 0;
        var pur = 0;
        unsetFormat();
        var diskon = $('#diskon').val();
        $("input[id*='total_price']").each(function() {
            sum += +$(this).val();
        });
        $("input[id*='purchase_price_product']").each(function() {
            pur += +$(this).val();
        });
        var total = sum - diskon;
        $('#total').val(total);
        $('#subtotal').val(sum);
        $('#purchase').val(pur);
        setFormat();
    }

    function removeProduct(el) {
        let elemen = el.parentElement.parentElement;
        elemen.remove();
        getSubTotal();
    }

    function setVoucher() {
        if ($('#type').val() == 1) {
            var diskon = $('#disc_value').val();
            $('#diskon').val(diskon);

        } else {
            unsetFormat();
            var diskon = $('#disc_value').val();
            var subtotal = $('#subtotal').val();
            var disc = (diskon * subtotal) / 100;
            $('#diskon').val(disc);
        }
        getSubTotal();
    }

    function deleteVoucher() {
        $('#diskon').val(0);
        $('#disc').val(0);
        $("#voucher option[value!='']").remove();
        getSubTotal();
    }

    $(('#formEdit')).submit(function(e) {
        $(".submit").prop('disabled', true);
        unsetFormat();
        e.preventDefault();
        $.ajax({
            url: "{{ route('transaction_edit_patch', $transaction->id) }}",
            type: "PATCH",
            data: $('#formEdit').serialize(),
            success: function(res) {
                toastr['success']("Produk Berhasil ditambahkan!");
                window.setTimeout(function() {
                    window.location.href = "{{ route('transaction') }}";
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
    $('.select2-name').select2({
        ajax: {
            url: "{{ url('/product/auto') }}",
            dataType: 'json',
            processResults: function(data, params) {
                return {
                    results: data
                };
            }
        },
        placeholder: 'Cari Nama Produk',
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
        $('#product_name').val(repo.name);
        $('#price').val(repo.price);
        $('#purchase_price').val(repo.purchase_price);
        if (repo.name != undefined) {
            return repo.name;
        } else {
            return repo.text;
        }
    }

    $('#qty').keyup(function(e) {
        $(this).val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });

    $('.select2-voucher').select2({
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
            if (repo.tipe == 2) {
                return repo.name + ' - ' + repo.sum + '%';
            } else {
                return repo.name + ' - ' + 'Rp' + repo.sum;
            }
        } else {
            return repo.text;
        }
    }

    function setFormat() {
        $("#subtotal").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
        $("#diskon").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
        $("#total").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    }

    function unsetFormat() {
        $("#subtotal").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        $("#diskon").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        $("#total").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        $("#totalall").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
    }
</script>
