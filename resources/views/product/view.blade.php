<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 row">
        <div class="col-sm">
            <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
        </div>
    </div>
    <div class="flex-grow-1 mr-3">
        <form id="formFilter" onsubmit="return false">
            <div class="row ml-3">
                <div class="col-sm-3">
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
                            placeholder="Cari Nama Produk atau Kode Produk" />
                    </div>
                </div>
                <div class="col-sm-2">
                    <p class="m-0">Status</p>
                    <select onchange="searchData()" id="status" name="status" class="form-control">
                        <option value="0">Tidak Aktif</option>
                        <option value="1" selected>Aktif</option>
                    </select>
                </div>
                <div class="col-sm mt-4 text-right">
                    <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addModal">
                        <h6 class="m-0 font-weight-bold text-white">Tambah Produk</h6>
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body" id="data">

    </div>
</div>
@include('product.modal.add')
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
            url: `product/data?page=` + page,
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
        let date = $('#date').val();

        $.ajax({
            url: `product/data`,
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
            url: `/product/edit/${id}`,
            method: 'GET',
            data: $('#formEdit').serialize(),
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#modal-container').html(data);
                $('#modal-edit').modal("show");
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                toastr['error']('Something Error');
            }
        })
    }

    function deleteData(id) {
        swal({
                title: "Apakah Anda Yakin ingin menghapus data ini??",
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: `/product/delete/${id}`,
                        method: 'DELETE',
                        data: {
                            'id': id,
                            '_token': '{{ csrf_token() }}',
                        },
                        success: function(res, data) {
                            if (res.status = true) {
                                swal("Sukses", "Berhasil dihapus", "success");
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
