<div class="card shadow mb-4">
    <div class="card-header py-3 row">
        <div class="col-sm">
            <h6 class="m-0 font-weight-bold text-primary">Produk</h6>
        </div>
        <div class="col-sm text-right">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                <h6 class="m-0 font-weight-bold text-white">Tambah Produk</h6>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori Produk</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Kriteria</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($product) == 0)
                        <tr>
                            <td colspan="7" class="text-center">No Data</td>
                        </tr>
                    @endif
                    @foreach ($product as $p)
                        <tr>
                            <td>{{ $p->code }}</td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->ProductCategory->category }}</td>
                            <td>RP {{ number_format($p->price, 0, '.', '.') }}</td>
                            <td>Rp {{ number_format($p->purchase_price, 0, '.', '.') }}</td>
                            <td>
                                <ul>
                                    @if ($p->new_product != 0)
                                        <li>New Product</li>
                                    @endif
                                    @if ($p->best_seller != 0)
                                        <li>Best Seller</li>
                                    @endif
                                    @if ($p->featured != 0)
                                        <li>Featured</li>
                                    @endif
                                </ul>
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="Edit({{ $p->id }})"><i
                                        class="fas fa-fw fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="deleteData({{ $p->id }})"><i
                                        class="fas f a-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('product.modal.add')
<div id="modal-container">

</div>
<script>
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
