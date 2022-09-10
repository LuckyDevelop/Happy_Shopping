<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 row">
        <div class="col-sm">
            <h6 class="m-0 font-weight-bold text-primary">Voucher</h6>
        </div>
    </div>
    <div class="flex-grow-1 mr-3">
        <form id="formFilter" onsubmit="return false">
            <div class="row ml-3">
                <div class="col-sm-2">
                    <div class="input-group w-10 mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </span>
                        </div>
                        <input type="text" onchange="searchData()" class="form-control" name="search"
                            placeholder="Cari Kode Voucher" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <p class="m-0">Start Date</p>
                    <input type="date" onchange="searchData()" style="width: 200px" name="start_date" id="start_date"
                        value="" class="form-control  w-100">
                </div>
                <div class="col-sm-2">
                    <p class="m-0">End Date</p>
                    <input type="date" onchange="searchData()" style="width: 200px" name="end_date" id="end_date"
                        value="" class="form-control w-100">
                </div>
                <div class="col-sm-2">
                    <p class="m-0">Status</p>
                    <select onchange="searchData()" id="status" name="status" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                        <option value="2">Kadaluarsa</option>
                        <option value="3">Terpakai</option>
                    </select>
                </div>
                <div class="col-sm mt-4 text-right">
                    <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <h6 class="m-0 font-weight-bold text-white">Tambah Voucher</h6>
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body" id="data">

    </div>
</div>
@include('voucher.modal.add')
<div id="modal-container">

</div>
<script>
    $(document).ready(function() {
        searchData();
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getData(page);
        })
    });

    function getData() {
        let formData = $('#formFilter').serialize();
        $.ajax({
            url: `voucher/data?page=` + page,
            method: 'GET',
            data: formData,
            success: function(data) {
                $('#data').html(data);
            },
            error: function(error) {
                toastr['error']('Something Error');
            }
        })
    }

    function searchData() {
        let formData = $('#formFilter').serialize();
        let start = $('#start_date').val();
        let end = $('#end_date').val();

        if (start > end) {
            toastr['error']('End Date tidak boleh dibawah Start Date');
        }

        $.ajax({
            url: `voucher/data`,
            method: 'GET',
            data: formData,
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#overlay').css("display", "none");
                $('#data').html(data)
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                toastr['error']('Tidak ada Data');
            }
        })
    }

    function Edit(id) {
        $.ajax({
            url: `/voucher/edit/${id}`,
            method: 'GET',
            data: $('#formEdit').serialize(),
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#modal-container').html(data);
                $('#editVoucher').modal("show");
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                toastr['error']('Something Error');
            }
        })
    }

    function deleteData(id) {
        swal({
                title: "Apakah Anda Yakin ingin menghapus Voucher ini??",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: `/voucher/delete/${id}`,
                        method: 'DELETE',
                        data: {
                            'id': id,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(res, data) {
                            if (res.status = true) {
                                swal("Sukses", "Voucher Berhasil dihapus", "success");
                                window.setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                toastr['error'](res.error);
                            }
                        },
                        error: function(error) {
                            toastr['error']('Something Error');
                        }
                    })
                } else {
                    swal("Batal menghapus");
                }
            });
    }
</script>
