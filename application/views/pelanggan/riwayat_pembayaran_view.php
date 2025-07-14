<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Riwayat Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pembayaran</th>
                            <th>Periode</th>
                            <th>Tanggal Bayar</th>
                            <th>Total Bayar</th>
                            <th>Biaya Admin</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($pembayaran as $p): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>PAY<?= $p->id_pembayaran ?></td>
                            <td><?= $p->bulan ?> <?= $p->tahun ?></td>
                            <td><?= date('d F Y, H:i', strtotime($p->tanggal_bayar)) ?></td>
                            <td>Rp <?= number_format($p->total_bayar, 0, ',', '.'); ?></td>
                            <td>Rp <?= number_format($p->biaya_admin, 0, ',', '.'); ?></td>
                            <td><?= $p->nama_petugas ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>