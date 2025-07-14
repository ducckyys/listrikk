<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('superadmin/dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15"> <i class="fas fa-bolt"></i> </div>
        <div class="sidebar-brand-text mx-3">Lektrikpay</div>
    </a>
    <hr class="sidebar-divider my-0">

    <?php if ($this->session->userdata('level') == 'superadmin'): ?>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('superadmin/dashboard') ?>"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('profile') ?>"><i class="fas fa-fw fa-user"></i><span>Profile</span></a></li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">User</div>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('superadmin/pelanggan') ?>"><i class="fas fa-fw fa-users"></i><span>Pelanggan</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('superadmin/petugas') ?>"><i class="fas fa-fw fa-user-tie"></i><span>Petugas</span></a></li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Data Master</div>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('superadmin/tarif') ?>"><i class="fas fa-fw fa-dollar-sign"></i><span>Tarif</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('superadmin/penggunaan') ?>"><i class="fas fa-fw fa-history"></i><span>Data Penggunaan</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('superadmin/tagihan') ?>"><i class="fas fa-fw fa-file-invoice"></i><span>Data Tagihan</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('superadmin/pembayaran') ?>"><i class="fas fa-fw fa-money-check-alt"></i><span>Data Pembayaran</span></a></li>

    <?php elseif ($this->session->userdata('level') == 'petugas'): ?>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('petugas/dashboard') ?>"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('profile') ?>"><i class="fas fa-fw fa-user"></i><span>Profile</span></a></li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Transaksi</div>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('petugas/tagihan') ?>"><i class="fas fa-fw fa-file-invoice"></i><span>Konfirmasi Tagihan</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('petugas/pembayaran') ?>"><i class="fas fa-fw fa-money-check-alt"></i><span>Data Pembayaran</span></a></li>
    
    <?php elseif ($this->session->userdata('level') == 'pelanggan'): ?>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('pelanggan/dashboard') ?>"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('profile') ?>"><i class="fas fa-fw fa-user"></i><span>Profile</span></a></li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">Listrik</div>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('pelanggan/penggunaan') ?>"><i class="fas fa-fw fa-charging-station"></i><span>Input Penggunaan</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('pelanggan/riwayat/tagihan') ?>"><i class="fas fa-fw fa-file-invoice-dollar"></i><span>Bayar Tagihan</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?= base_url('pelanggan/riwayat/pembayaran') ?>"><i class="fas fa-fw fa-history"></i><span>Riwayat Pembayaran</span></a></li>
    <?php endif; ?>
    
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout') ?>" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-fw fa-sign-out-alt"></i><span>Logout</span>
        </a>
    </li>
</ul>