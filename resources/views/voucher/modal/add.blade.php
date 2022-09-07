<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAdd">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <h6 class="font-weight-bold">Tipe<span class="text-danger">*</span></h6>
                        <select class="form-select" onchange="setTotal()" name="type" id="type"
                            aria-label="Default select example">
                            <option value="" selected>Pilih Tipe Diskon</option>
                            <option value="1">Flat Diskon</option>
                            <option value="2">Percent Diskon</option>
                        </select>
                    </div>
                    <div class="form-group" id="percent_discount" hidden>
                        <label class="font-weight-bold">Total Diskon<span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="number" min="0" max="100" name="percent_disc" class="form-control"
                                placeholder="Max Disc 100%" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>

                    <div class="form-group" id="flat_discount" hidden>
                        <label class="font-weight-bold">Total Diskon<span class="text-danger">*</span></label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Rp</span>
                            <input type="text" class="form-control" id="flat_disc" name="flat_disc"
                                placeholder="Masukkan Total Diskon" aria-describedby="addon-wrapping">
                        </div>
                    </div>

                    <div class="form-group row">
                        <h6 class="font-weight-bold">Masa Berlaku<span class="text-danger">*</span></h6>
                        <div class="col-sm">
                            <p class="m-0">Dari</p>
                            <input type="date" onchange="searchData()" style="width: 200px" name="start_date"
                                id="start_date" value="{{ Carbon::now()->format('Y-m-d') }}"
                                class="form-control  w-100">
                        </div>
                        <div class="col-sm">
                            <p class="m-0">Sampai</p>
                            <input type="date" onchange="searchData()" style="width: 200px" name="end_date"
                                id="end_date" value="{{ Carbon::now()->format('Y-m-d') }}" class="form-control w-100">
                        </div>
                    </div>
                    <div class="form-group">
                        <h6 class="font-weight-bold">Status<span class="text-danger">*</span></h6>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option value="0">Tidak Aktif</option>
                            <option value="1" selected>Aktif</option>
                        </select>
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
    $('#flat_disc').keyup(function(e) {
        $("#flat_disc").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        });
    });

    function setTotal() {
        let type = $('#type').val();

        if (type == 1) {
            $('#flat_discount').removeAttr('hidden');
        } else {
            $('#flat_discount').attr('hidden', true);
        }
        if (type == 2) {
            $('#percent_discount').removeAttr('hidden');
        } else {
            $('#percent_discount').attr('hidden', true);
        }
    }

    $(('#formAdd')).submit(function(e) {
        e.preventDefault();
        $("#flat_disc").val(function(index, value) {
            return value
                .replace(/^0+/, '')
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, "");
        });
        $.ajax({
            url: "{{ route('voucher_add_post') }}",
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
