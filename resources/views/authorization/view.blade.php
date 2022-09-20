<!-- DataTales Example -->
<div class="card shadow mb-4">
    <form id="formFilter" onsubmit="return false">
        @csrf
        <div class="card-header py-3 row">
            <div class="col-sm">
                <h6 class="m-0 font-weight-bold text-primary">Otorisasi</h6>
            </div>
        </div>
        <div class="flex-grow-1 mr-3 mb-3">
            <div class="row ml-2 mt-3">
                <div class="col-sm-2">
                    <select name="role" id="role" onchange="getData()" class="form-control">
                        @foreach ($role as $i)
                            <option value="{{ $i->id }}" @if ($loop->last) selected @endif>
                                {{ $i->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-1 button-authorization">
                    <button type="button" class="btn btn-primary text-white"
                        onclick="updateAuthorization()">Update</button>
                </div>
                <div class="col-sm-1">
                    <div id="loading" style="display: none">
                        <img src="{{ asset('image/ajax-loader.gif') }}" style="margin-top: 12px;margin-left: 15px;">
                    </div>
                </div>
                <div class="col-sm-2 ml-auto mt-1">
                    <input type="checkbox" name="select-all" id="select-all" /> Tandai Semua
                </div>
            </div>
        </div>
        <div id="data">
            @include('authorization.data')
        </div>
    </form>
</div>
<script>
    function getData() {
        let formData = $('#formFilter').serialize();
        let role = $('#role').find(':selected').val();
        $.ajax({
            url: `authorization/data/${role}`,
            method: 'GET',
            data: formData,
            success: function(data) {
                $('#data').html(data);
            },
            error: function(error) {
                toastr['error']('Something Error');
            }
        })
    }

    $('#select-all').click(function(event) {
        if (this.checked) {
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });

    function updateAuthorization() {
        let formData = $('#formFilter').serialize();

        $.ajax({
            url: `/authorization`,
            method: 'POST',
            data: formData,
            success: function(data) {
                toastr['success']('Berhasil diupdate');
                getData();
            },
            error: function(error) {
                toastr['error']('Ubah data terlebih dahulu!');
            }
        })
    }
</script>
