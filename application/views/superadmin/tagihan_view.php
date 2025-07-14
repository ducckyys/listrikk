<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Tagihan</th>
                            <th>Pelanggan</th>
                            <th>Periode</th>
                            <th>Jumlah Bayar</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tagihan as $t): ?>
                        <tr>
                            <td>TG<?= $t->id_tagihan ?></td>
                            <td><?= $t->nama_lengkap ?> (PLG<?= $t->id_pelanggan ?>)</td>
                            <td><?= $t->bulan ?> <?= $t->tahun ?></td>
                            <td>Rp <?= number_format($t->jumlah_bayar, 0, ',', '.'); ?></td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>