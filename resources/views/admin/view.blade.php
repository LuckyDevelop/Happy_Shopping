<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 row">
        <div class="col-sm">
            <h6 class="m-0 font-weight-bold text-primary">Admin</h6>
        </div>
    </div>
    <div class="flex-grow-1 mr-3">
        <form id="formFilter" onsubmit="return false">
            <div class="row ml-3">
                {{-- <div class="col-sm-3">
                    <div class="input-group w-10 mt-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </span>
                        </div>
                        <input type="text" onchange="searchData()" class="form-control" name="search"
                            placeholder="Cari Kode Voucher atau Kode Transaksi" />
                    </div>
                </div> --}}
                {{-- <div class="col-sm-2">
                    <p class="m-0">Start Date</p>
                    <input type="date" onchange="searchData()" style="width: 200px" name="start_date" id="start_date"
                        value="{{ Carbon::now()->format('Y-m-d') }}" class="form-control  w-100">
                </div>
                <div class="col-sm-2">
                    <p class="m-0">End Date</p>
                    <input type="date" onchange="searchData()" style="width: 200px" name="end_date" id="end_date"
                        value="{{ Carbon::now()->format('Y-m-d') }}" class="form-control w-100">
                </div> --}}
                <div class="col-sm mt-4 text-right">
                    <a href="{{ route('account-list_add_data') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body" id="data">

    </div>
</div>
<script>
    $(document).ready(function() {
        searchData();
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            getData(page);
        })
    });

    function getData() {
        let formData = $('#formFilter').serialize();
        $.ajax({
            url: `account-list/data?page=` + page,
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

    function searchData() {
        let formData = $('#formFilter').serialize();
        let start = $('#start_date').val();
        let end = $('#end_date').val();

        if (start > end) {
            toastr['error']('End Date tidak boleh dibawah Start Date');
        }

        $.ajax({
            url: `account-list/data`,
            method: 'GET',
            data: formData,
            beforeSend: function(e) {
                $('#overlay').css("display", "block");
            },
            success: function(data) {
                $('#overlay').css("display", "none");
                $('#data').html(data)
            },
            error: function(error) {
                $('#overlay').css("display", "none");
                toastr['error']('Something Error');
            }
        })
    }
</script>
