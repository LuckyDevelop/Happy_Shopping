<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode Voucher</th>
                <th>Type</th>
                <th>Total Diskon</th>
                <th>Masa Berlaku</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($voucher) == 0)
                <tr>
                    <td colspan="6" class="text-center">No Data</td>
                </tr>
            @endif
            @foreach ($voucher as $v)
                <tr>
                    <td>{{ $v->code }}</td>
                    <td>
                        @if ($v->type == 1)
                            Flat Diskon
                        @elseif($v->type == 2)
                            Persen Diskon
                        @endif
                    </td>
                    <td>Rp {{ number_format($v->disc_value, 0, '.', '.') }}</td>
                    <td>
                        {{ $v->start_date }} - {{ $v->end_date }}
                    </td>
                    <td>
                        @if ($v->status == 1)
                            Aktif
                        @else
                            Kadaluarsa
                        @endif
                    </td>
                    <td>
                        <a href="javascript:void(0)" onclick="Edit({{ $v->id }})"><i
                                class="fas fa-fw fa-edit"></i></a>
                        <a href="javascript:void(0)" onclick="deleteData({{ $v->id }})"><i
                                class="fas f a-fw fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
