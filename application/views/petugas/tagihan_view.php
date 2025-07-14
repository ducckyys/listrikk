<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tagihan Pelanggan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID Tagihan</th>
                            <th>Pelanggan</th>
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
                            <td><?= $t->nama_lengkap ?></td>
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
                                <?php if($t->status == 'Menunggu Konfirmasi'): ?>
                                    <a href="<?= base_url('petugas/tagihan/konfirmasi_pembayaran/' . $t->id_tagihan) ?>" class="btn btn-sm btn-success" onclick="return confirm('Anda yakin tagihan ini sudah dibayar?')">
                                        Konfirmasi Pembayaran
                                    </a>
                                <?php else: ?>
                                    -
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