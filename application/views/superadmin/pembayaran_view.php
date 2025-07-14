<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Pembayaran</th>
                            <th>Pelanggan</th>
                            <th>Periode</th>
                            <th>Total Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pembayaran as $p): ?>
                        <tr>
                            <td>PAY<?= $p->id_pembayaran ?></td>
                            <td><?= $p->nama_pelanggan ?> (PLG<?= $p->id_pelanggan ?>)</td>
                            <td><?= $p->bulan ?> <?= $p->tahun ?></td>
                            <td>Rp <?= number_format($p->total_bayar, 0, ',', '.'); ?></td>
                            <td><?= date('d F Y, H:i', strtotime($p->tanggal_bayar)) ?></td>
                            <td><?= $p->nama_petugas ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>