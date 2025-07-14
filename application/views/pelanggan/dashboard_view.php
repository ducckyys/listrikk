<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="alert alert-info">
        Hai <strong><?= $this->session->userdata('nama_lengkap'); ?>!</strong> Selamat datang di halaman dashboard Anda.
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pembayaran (Tahun Ini)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($pembayaran_tahunan ?: 0, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_transaksi ?: 0; ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-exchange-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Tunggakan (Dari <?= $tunggakan->jumlah_tunggakan ?: 0; ?> Tagihan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($tunggakan->total_tunggakan ?: 0, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi KWH Anda</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Nomor KWH:</strong>
                            <p><?= $info_kwh->nomor_kwh ?? 'N/A'; ?></p>
                        </div>
                        <div class="col-md-4">
                            <strong>Daya:</strong>
                            <p><?= $info_kwh->daya ?? 'N/A'; ?></p>
                        </div>
                        <div class="col-md-4">
                            <strong>Tarif per KWH:</strong>
                            <p>Rp <?= number_format($info_kwh->tarif_per_kwh ?? 0, 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>