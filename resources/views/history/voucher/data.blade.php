<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode Voucher</th>
                <th>Kode Transaksi</th>
                <th>Tipe Diskon</th>
                <th>Total Diskon</th>
                <th>Tanggal Pemakaian</th>
            </tr>
        </thead>
        <tbody>
            @if (count($usage) == 0)
                <tr>
                    <td colspan="6" class="text-center">No Data</td>
                </tr>
            @endif
            @foreach ($usage as $v)
                <tr>
                    <td>{{ $v->Voucher->code }}</td>
                    <td>{{ $v->Transaction->transaction_id }}</td>
                    <td>
                        @if ($v->Voucher->type == 1)
                            Flat Diskon
                        @elseif($v->Voucher->type == 2)
                            Persen Diskon
                        @endif
                    </td>
                    <td>
                        {{ number_format($v->discounted_value, 0, '.', '.') }}
                    </td>
                    <td>
                        {{ Carbon::parse($v->created_at)->format('d F Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $usage->links() }}
