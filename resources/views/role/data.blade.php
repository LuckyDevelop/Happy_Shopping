<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($role) == 0)
                <tr>
                    <td colspan="3" class="text-center">No Data</td>
                </tr>
            @endif
            @php
                $n = 1;
            @endphp
            @foreach ($role as $r)
                <tr>
                    <td>{{ $n++ }}</td>
                    <td>{{ $r->name }}</td>
                    <td>
                        <x-button-edit href="{{ route('role_edit_data', [$r->id]) }}" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $role->links() }}
