<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard_view_index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><sup>Happy</sup>Shopping</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    @foreach (Helper::getMenunull() as $item)
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/' . $item->route) }}">
                <i class="{{ $item->icon }}"></i>
                <span>{{ $item->name }}</span></a>
        </li>
    @endforeach
    {{-- @foreach (Helper::getGroupmenu() as $groupmenu)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-boxes"></i>
                <span>Produk</span>
            </a>
        </li>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Produk :</h6>
                <a class="collapse-item" href="{{ route('product') }}">Produk</a>
                <a class="collapse-item" href="{{ route('category') }}">Kategori</a>
            </div>
        </div>
    @endforeach --}}
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Produk</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Produk :</h6>
                <a class="collapse-item" href="{{ route('product_view_index') }}">Produk</a>
                <a class="collapse-item" href="{{ route('category_view_index') }}">Kategori</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-clock"></i>
            <span>Riwayat Transaksi</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Riwayat :</h6>
                <a class="collapse-item" href="{{ route('voucher-usage_view') }}">Transaksi Voucher</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-lock"></i>
            <span>User & Otorisasi</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu :</h6>
                <a class="collapse-item" href="{{ route('role_view_index') }}">Peran</a>
                <a class="collapse-item" href="{{ route('authorization_view_index') }}">Otorisasi</a>
                <a class="collapse-item" href="{{ route('account-list_view_index') }}">Admin</a>
            </div>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->
