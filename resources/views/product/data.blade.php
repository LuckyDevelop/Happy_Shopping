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
                <th>Status</th>
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
                        @if ($p->status == 1)
                            <label class="mb-1 px-3 bg-success text-white text-center"
                                style="border-radius: 10pt">Aktif</label>
                        @else
                            <label class="mb-1 px-3 bg-secondary text-white text-center"
                                style="border-radius: 10pt">Tidak Aktif</label>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('product_edit', $p->id) }}"><i class="fas fa-fw fa-edit"></i></a>
                        <a href="javascript:void(0)" onclick="deleteData({{ $p->id }})"><i
                                class="fas f a-fw fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
