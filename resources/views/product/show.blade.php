<div class="card mx-4">
    <div class="card-body ml-1">
        <h3 class="card-title font-weight-bold ml-2">Kode Produk {{ $product->code }}</h3>
        <div class="row pt-3">
            <div class="col-sm-6">
                <h4 class="font-weight-bold ml-2">Data Produk</h4>
                <div class="col-sm mt-3">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Nama Produk
                        </div>
                        <div class="col-sm-3">: {{ $product->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Kategori Produk
                        </div>
                        <div class="col-sm-3">: {{ $product->ProductCategory->category }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Harga Beli
                        </div>
                        <div class="col-sm-3">: Rp {{ number_format($product->purchase_price, 0, '.', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Harga Jual
                        </div>
                        <div class="col-sm-3">: Rp {{ number_format($product->price, 0, '.', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Kriteria
                        </div>
                        <div class="col-sm-3">
                            <ul>
                                @if ($product->new_product != 0)
                                    <li>New Product</li>
                                @endif
                                @if ($product->best_seller != 0)
                                    <li>Best Seller</li>
                                @endif
                                @if ($product->featured != 0)
                                    <li>Featured</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Status
                        </div>
                        <div class="col-sm-3">:
                            @if ($product->status == 1)
                                <label class="mb-1 px-3 bg-success text-white text-center"
                                    style="border-radius: 10pt">Aktif</label>
                            @else
                                <label class="mb-1 px-3 bg-secondary text-white text-center"
                                    style="border-radius: 10pt">Tidak Aktif</label>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Short Description
                        </div>
                        <div class="col-sm-3">:
                            @if ($product->short_description == null)
                                Tidak ada
                            @else
                                {{ $product->short_description }}
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Description
                        </div>
                        <div class="col-sm-3">:
                            @if ($product->description == null)
                                Tidak ada
                            @else
                                {{ $product->description }}
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
