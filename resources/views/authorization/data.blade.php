<div class="table-responsive">
    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Lihat</th>
                <th>Tambah</th>
                <th>Ubah</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            @php
                $n = 1;
            @endphp
            @foreach ($menu as $m)
                <tr>
                    <td>{{ $m->name }}</td>
                    @foreach ($type as $t)
                        <td>
                            <input class="toast-top-center" type="checkbox" name="menu_tipe[]"
                                value="{{ $m->id . '_' . $t->id }}"
                                @foreach ($authorization as $j) @if ($j->menus_id . '_' . $j->authorization_types_id == $m->id . '_' . $t->id)
                    checked @else @endif @endforeach>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
