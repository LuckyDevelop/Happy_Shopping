<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Email Pelanggan</th>
                {{-- <th>Sub Total</th>
                <th>Diskon</th>
                <th>Grand Total</th> --}}
                <th>Tanggal Transaksi</th>
                <th>Metode Pembayaran</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($transaction) == 0)
                <tr>
                    <td colspan="7" class="text-center">No Data</td>
                </tr>
            @endif
            @foreach ($transaction as $t)
                <tr>
                    <td>{{ $t->transaction_id }}</td>
                    <td>{{ $t->customer_name }}</td>
                    <td>{{ $t->customer_email }}</td>
                    {{-- <td>Rp {{ number_format($t->sub_total, 0, '.', '.') }}</td>
                    <td>Rp {{ number_format($t->sub_total - $t->total, 0, '.', '.') }}</td>
                    <td>Rp {{ number_format($t->total, 0, '.', '.') }}</td> --}}
                    <td>{{ Carbon::parse($t->created_at)->isoFormat('d MMMM Y') }}</td>
                    <td>{{ $t->payment_method }}</td>
                    <td>
                        @if ($t->status == 0)
                            <label class="mb-1 px-3 bg-marroon text-white text-center"
                                style="border-radius: 10pt">Cancelled</label>
                        @elseif($t->status == 1)
                            <label class="mb-1 px-3 bg-warning text-white text-center"
                                style="border-radius: 10pt">Pending</label>
                        @elseif($t->status == 2)
                            <label class="mb-1 px-3 bg-success text-white text-center"
                                style="border-radius: 10pt">Done/Paid</label>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('transaction_show', [$t->id]) }}"><i class="fas fa-fw fa-eye"></i></a>
                        @if ($t->status == 1)
                            <a href="{{ route('transaction_edit', [$t->id]) }}"><i class="fas fa-fw fa-edit"></i></a>
                        @endif
                        {{-- <a href="javascript:void(0)" onclick="deleteData({{ $t->id }})"><i
                                class="fas f a-fw fa-trash"></i></a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $transaction->links() }}
