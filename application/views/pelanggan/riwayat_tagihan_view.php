<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Bayar Tagihan</h1>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"> <?= $this->session->flashdata('success'); ?> </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Table Bayar Tagihan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Tagihan</th>
                            <th>Periode</th>
                            <th>Jumlah Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($tagihan as $t): ?>
                        <tr>
                            <td>TG<?= $t->id_tagihan ?></td>
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
                            <td>
                                <?php if($t->status == 'Belum Lunas'): ?>
                                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bayarModal<?= $t->id_tagihan ?>">
                                        Bayar
                                    </button>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>

                        <div class="modal fade" id="bayarModal<?= $t->id_tagihan ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Anda akan melakukan pembayaran untuk tagihan periode <strong><?= $t->bulan ?> <?= $t->tahun ?></strong>.</p>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span>Tagihan</span>
                                            <strong>Rp <?= number_format($t->jumlah_bayar, 0, ',', '.'); ?></strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Biaya Admin</span>
                                            <strong>Rp 2.500</strong>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between font-weight-bold">
                                            <span>Total Bayar</span>
                                            <span>Rp <?= number_format($t->jumlah_bayar + 2500, 0, ',', '.'); ?></span>
                                        </div>
                                        <hr>
                                        <p>Apakah Anda yakin ingin melanjutkan?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a class="btn btn-primary" href="<?= base_url('pelanggan/riwayat/proses_bayar/' . $t->id_tagihan) ?>">Ya, Lanjutkan Pembayaran</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>