<div class="card mx-4">
    <div class="card-body ml-1">
        <h3 class="card-title font-weight-bold ml-2">Kode Voucher {{ $voucher->code }}</h3>
        <div class="row pt-3">
            <div class="col-sm-6">
                <h4 class="font-weight-bold ml-2">Detail Voucher</h4>
                <div class="col-sm mt-3">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Tipe Diskon
                        </div>
                        <div class="col-sm-3">:
                            @if ($voucher->type == 1)
                                Flat
                            @else
                                (%)
                                Persen
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Total Diskon
                        </div>
                        <div class="col-sm-3">:
                            @if ($voucher->type == 1)
                                Rp {{ number_format($voucher->disc_value, 0, '.', '.') }}
                            @else
                                {{ round($voucher->disc_value) }}%
                            @endif
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Masa Berlaku
                        </div>
                        <div class="col-sm-3">:
                            {{ Carbon::parse($voucher->start_date)->isoFormat('d MMMM Y') }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Tanggal Kadaluarsa
                        </div>
                        <div class="col-sm-3">:
                            {{ Carbon::parse($voucher->end_date)->isoFormat('d MMMM Y') }}
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            Status
                        </div>
                        <div class="col-sm-3">:
                            @if ($voucher->status == 1)
                                <label class="mb-1 px-3 bg-success text-white text-center"
                                    style="border-radius: 10pt">Aktif</label>
                            @elseif ($voucher->status == 0)
                                <label class="mb-1 px-3 bg-secondary text-white text-center"
                                    style="border-radius: 10pt">Tidak Aktif</label>
                            @elseif ($voucher->status == 2)
                                <label class="mb-1 px-3 bg-warning text-white text-center"
                                    style="border-radius: 10pt">Kadaluarsa</label>
                            @elseif ($voucher->status == 3)
                                <label class="mb-1 px-3 bg-info text-white text-center"
                                    style="border-radius: 10pt">Terpakai</label>
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
