<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="alert alert-info">
        Hai <strong><?= $this->session->userdata('nama_lengkap'); ?>!</strong> Selamat datang di halaman dashboard petugas.
    </div>

    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Seluruh Tagihan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_tagihan; ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Tagihan Terbaru dari Pelanggan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Tagihan</th>
                            <th>Nama Pelanggan</th>
                            <th>Periode</th>
                            <th>Jumlah Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($tagihan_terbaru)): ?>
                            <?php foreach($tagihan_terbaru as $t): ?>
                            <tr>
                                <td>TG<?= $t->id_tagihan ?></td>
                                <td><?= $t->nama_lengkap ?></td>
                                <td><?= $t->bulan ?> <?= $t->tahun ?></td>
                                <td>Rp <?= number_format($t->jumlah_bayar, 0, ',', '.') ?></td>
                                <td>
                                    <?php if($t->status == 'Lunas'): ?>
                                        <span class="badge badge-success">Lunas</span>
                                    <?php elseif($t->status == 'Menunggu Konfirmasi'): ?>
                                        <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">Belum Lunas</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data tagihan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>