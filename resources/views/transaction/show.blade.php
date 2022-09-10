<div class="card mx-4">
    <div class="card-body ml-1">
        <h3 class="card-title font-weight-bold ml-2">Nomor Transaksi {{ $transaction->transaction_id }}</h3>
        <div class="row pt-3">
            <div class="col-sm-6">
                <h4 class="font-weight-bold ml-2">Data Pelanggan</h4>
                <div class="col-sm mt-3">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Nama Pelanggan
                        </div>
                        <div class="col-sm-3">: {{ $transaction->customer_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Email Pelanggan
                        </div>
                        <div class="col-sm-3">: {{ $transaction->customer_email }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            No. HP Pelanggan
                        </div>
                        <div class="col-sm-3">: {{ $transaction->customer_phone }}</div>
                    </div>
                </div>
                <div class="col-sm mt-4">
                    <h4 class="font-weight-bold">Detail Produk</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $qty = 0;
                                $price = 0;
                                $total = 0;
                            @endphp
                            @foreach ($transaction->TransactionDetail as $td)
                                @php
                                    $qty += $td->qty;
                                    $price += $td->price_satuan;
                                    $total += $td->price_total;
                                @endphp
                                <tr>
                                    <td>
                                        {{ $td->Product->name }}
                                    </td>
                                    <td>
                                        {{ $td->qty }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($td->price_satuan, 0, '.', '.') }}
                                    </td>
                                    <td>
                                        Rp {{ number_format($td->price_total, 0, '.', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="font-weight-bold">
                                <td>TOTAL</td>
                                <td>{{ $qty }}</td>
                                <td>Rp {{ number_format($price, 0, '.', '.') }}</td>
                                <td>Rp {{ number_format($total, 0, '.', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm mt-3">
                    <h4 class="font-weight-bold">Detail Transaksi</h4>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Sub Total
                        </div>
                        <div class="col-sm-3">: Rp {{ number_format($transaction->sub_total, 0, '.', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Diskon/Potongan
                        </div>
                        <div class="col-sm-3">: Rp
                            {{ number_format($transaction->sub_total - $transaction->total, 0, '.', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Total
                        </div>
                        <div class="col-sm-3">: Rp {{ number_format($transaction->total, 0, '.', '.') }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Metode Pembayaran
                        </div>
                        <div class="col-sm-3">: {{ $transaction->payment_method }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Status
                        </div>
                        <div class="col-sm-3">:
                            @if ($transaction->status == 0)
                                <label class="mb-1 px-3 bg-marroon text-white text-center"
                                    style="border-radius: 10pt">Cancelled</label>
                            @elseif($transaction->status == 1)
                                <label class="mb-1 px-3 bg-warning text-white text-center"
                                    style="border-radius: 10pt">Pending</label>
                            @elseif($transaction->status == 2)
                                <label class="mb-1 px-3 bg-success text-white text-center"
                                    style="border-radius: 10pt">Done/Paid</label>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm mt-3">
            <a href="{{ route('transaction') }}" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Kembali</span>
            </a>
        </div>
    </div>
</div>
