<!-- Modal -->
<div class="modal fade" id="editVoucher" tabindex="-1" aria-labelledby="editVoucherLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVoucherLabel">Edit Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEdit">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <h6 class="font-weight-bold">Kode Voucher</h6>
                        <input type="text" class="form-control" value="{{ $voucher->code }}" readonly>
                        <input type="hidden" name="id" value="{{ $voucher->id }}">
                    </div>
                    <div class="form-group">
                        <h6 class="font-weight-bold">Tipe<span class="text-danger">*</span></h6>
                        <select class="form-select" onchange="setTotal()" name="type" id="edit_type"
                            aria-label="Default select example">
                            <option value="" selected>Pilih Tipe Diskon</option>
                            <option value="1" @if ($voucher->type == 1) selected @endif>Flat Diskon
                            </option>
                            <option value="2" @if ($voucher->type == 2) selected @endif>Percent Diskon
                            </option>
                        </select>
                    </div>
                    <div id="voucher-data">
                        @if ($voucher->type == 1)
                            <div class="form-group" id="edit_flat_discount">
                                <label class="font-weight-bold">Total Diskon<span class="text-danger">*</span></label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">Rp</span>
                                    <input type="text" class="form-control" id="edit_flat_disc" name="flat_disc"
                                        placeholder="Masukkan Total Diskon" aria-describedby="addon-wrapping"
                                        @if ($voucher->type == 1) value="{{ number_format($voucher->disc_value, 0, '.', '.') }}" @endif>
                                </div>
                            </div>
                        @elseif ($voucher->type == 2)
                            <div class="form-group" id="edit_percent_discount">
                                <label class="font-weight-bold">Total Diskon<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <input type="number" min="0" max="100" name="percent_disc"
                                        class="form-control" placeholder="Max Disc 100%" aria-describedby="basic-addon2"
                                        @if ($voucher->type == 2) value="{{ round($voucher->disc_value) }}" @endif>
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="form-group" id="edit_percent_discount" hidden>
                        <label class="font-weight-bold">Total Diskon<span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="number" min="0" max="100" name="percent_disc" class="form-control"
                                placeholder="Max Disc 100%" aria-describedby="basic-addon2"
                                @if ($voucher->type == 2) value="{{ round($voucher->disc_value) }}" @endif>
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                    <div class="form-group" id="edit_flat_discount" hidden>
                        <label class="font-weight-bold">Total Diskon<span class="text-danger">*</span></label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Rp</span>
                            <input type="text" class="form-control" id="edit_flat_disc" name="flat_disc"
                                placeholder="Masukkan Total Diskon" aria-describedby="addon-wrapping"
                                @if ($voucher->type == 1) value="{{ number_format($voucher->disc_value, 0, '.', '.') }}" @endif>
                        </div>
                    </div>

                    <div class="form-group row">
                        <h6 class="font-weight-bold">Masa Berlaku<span class="text-danger">*</span></h6>
                        <div class="col-sm">
                            <p class="m-0">Dari</p>
                            <input type="date" onchange="searchData()" style="width: 200px" name="start_date"
                                id="start_date" value="{{ Carbon::parse($voucher->start_date)->format('Y-m-d') }}"
                                class="form-control  w-100">
                        </div>
                        <div class="col-sm">
                            <p class="m-0">Sampai</p>
                            <input type="date" onchange="searchData()" style="width: 200px" name="end_date"
                                id="end_date" value="{{ Carbon::parse($voucher->end_date)->format('Y-m-d') }}"
                                class="form-control w-100">
                        </div>
                    </div>
                    <div class="form-group">
                        <h6 class="font-weight-bold">Status<span class="text-danger">*</span></h6>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option value="0" @if ($voucher->status == 0) selected @endif>Tidak Aktif
                            </option>
                            <option value="1" @if ($voucher->status == 1) selected @endif>Aktif</option>
                        </select>
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
    $('#edit_flat_disc').keyup(function(e) {
        $("#edit_flat_disc").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });

    function setTotal() {
        let type = $('#edit_type').val();
        console.log(type);
        if (type == 1) {
            $('#edit_flat_discount1').remove();
            $('#edit_flat_discount').removeAttr('hidden');
        } else {
            $('#edit_flat_discount').attr('hidden', true);
        }
        if (type == 2) {
            $('#edit_percent_discount').removeAttr('hidden');
        } else {
            $('#edit_percent_discount').attr('hidden', true);
        }
    }

    $(('#formEdit')).submit(function(e) {
        e.preventDefault();
        $("#edit_flat_disc").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        $.ajax({
            url: `{{ route('voucher_edit_patch') }}`,
            type: "PATCH",
            data: $('#formEdit').serialize(),
            success: function(res) {
                toastr['success']("Voucher Berhasil diubah!");
                // window.setTimeout(function() {
                //     window.location.reload();
                // }, 1000);
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
