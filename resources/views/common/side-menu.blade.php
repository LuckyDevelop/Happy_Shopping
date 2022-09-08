<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><sup>Happy</sup>Shopping</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-home"></i>
            <span>Beranda</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Produk</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Produk :</h6>
                <a class="collapse-item" href="{{ route('product') }}">Produk</a>
                <a class="collapse-item" href="{{ route('category') }}">Kategori</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('voucher') }}">
            <i class="fas fa-fw fa-tag"></i>
            <span>Voucher</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transaction') }}">
            <i class="fas fa-fw fa-money-bill"></i>
            <span>Transaksi</span></a>
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
                <a class="collapse-item" href="{{ route('transaction-detail') }}">Transaksi</a>
                <a class="collapse-item" href="{{ route('voucher-usage') }}">Transaksi Voucher</a>
            </div>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->
