<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 row">
        <div class="col-sm">
            <h6 class="m-0 font-weight-bold text-primary">Kategori Produk</h6>
        </div>
        <div class="col-sm text-right">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <h6 class="m-0 font-weight-bold text-white">Tambah Kategori Produk</h6>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Kategori Produk</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($category) == 0)
                        <tr>
                            <td colspan="3" class="text-center">No Data</td>
                        </tr>
                    @endif
                    @foreach ($category as $c)
                        <tr>
                            <td>{{ $c->category }}</td>
                            <td>
                                @if ($c->description)
                                    {{ $c->description }}
                                @else
                                    Tidak Ada
                                @endif
                            </td>
                            <td>
                                <a href="javascript:void(0)" onclick="Edit({{ $c->id }})"><i
                                        class="fas fa-fw fa-edit"></i></a>
                                <a href="javascript:void(0)" onclick="deleteData({{ $c->id }})"><i
                                        class="fas f a-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('category.modal.add')
<div id="modal-container">

</div>
<script>
    function Edit(id) {
        $.ajax({
            url: `/product-category/edit/${id}`,
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
                        url: `/product-category/delete/${id}`,
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
