<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Penggunaan</th>
                            <th>Pelanggan</th>
                            <th>Periode</th>
                            <th>Meter Awal</th>
                            <th>Meter Akhir</th>
                            <th>Daya</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($penggunaan as $p): ?>
                        <tr>
                            <td>PN<?= $p->id_penggunaan ?></td>
                            <td><?= $p->nama_lengkap ?> (PLG<?= $p->id_pelanggan ?>)</td>
                            <td><?= $p->bulan ?> <?= $p->tahun ?></td>
                            <td><?= $p->meter_awal ?></td>
                            <td><?= $p->meter_akhir ?></td>
                            <td><?= $p->daya ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>