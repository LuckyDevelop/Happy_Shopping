<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($admin) == 0)
                <tr>
                    <td colspan="3" class="text-center">No Data</td>
                </tr>
            @endif
            @php
                $n = 1;
            @endphp
            @foreach ($admin as $a)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $a->username }}</td>
                    <td>{{ $a->Role->name }}</td>
                    <td>
                        <x-button-edit href="{{ route('account-list_edit_data', [$a->id]) }}" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $admin->links() }}
