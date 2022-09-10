<div class="card mx-4">
    <div class="card-body ml-1">
        <h3 class="card-title font-weight-bold ml-2">Kategori Produk</h3>
        <div class="row pt-3">
            <div class="col-sm-6">
                <h4 class="font-weight-bold ml-2">Detail</h4>
                <div class="col-sm mt-3">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Kategori
                        </div>
                        <div class="col-sm-3">: {{ $category->category }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Deskripsi
                        </div>
                        <div class="col-sm-3">:
                            @if ($category->description != null)
                                {{ $category->description }}
                            @else
                                Tidak Ada
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm mt-3">
            <a href="{{ route('product') }}" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>
    </div>
</div>
