<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Kode Voucher</th>
                <th>Tipe Diskon</th>
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
                    @if ($v->type == 1)
                        <td>
                            Flat Diskon
                        </td>
                        <td>
                            Rp {{ number_format($v->disc_value, 0, '.', '.') }}
                        </td>
                    @elseif($v->type == 2)
                        <td>
                            (%)
                            Persen
                        </td>
                        <td>
                            {{ round($v->disc_value) }}%
                        </td>
                    @endif
                    @php
                        $date1 = new DateTime($v->start_date);
                        $date2 = new DateTime($v->end_date);
                        $interval = $date1->diff($date2);

                    @endphp
                    <td>
                        {{ Carbon::parse($v->start_date)->format('d F Y') }} -
                        {{ Carbon::parse($v->end_date)->format('d F Y') }}
                        @if ($interval->d != 0)
                            ( {{ $interval->d }} Hari
                            @if ($interval->m != 0)
                                {{ $interval->m }} Bulan
                                @if ($interval->y != 0)
                                    {{ $interval->y }} Tahun
                                @endif
                            @endif
                            )
                        @endif
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
{{ $voucher->links() }}
