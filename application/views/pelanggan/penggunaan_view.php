<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Penggunaan</h1>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <?php endif; ?>
    <?php if (validation_errors()): ?>
    <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header"><h6 class="m-0 font-weight-bold text-primary">Input Penggunaan & Buat Tagihan</h6></div>
        <div class="card-body">
            <form action="<?= base_url('pelanggan/penggunaan/tambah') ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Bulan</label>
                        <select name="bulan" class="form-control" required>
                            <option value="">-- Pilih Bulan --</option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Tahun</label>
                        <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2025" value="<?= date('Y') ?>" required>
                    </div>
                     <div class="form-group col-md-3">
                        <label>Meter Awal</label>
                        <input type="number" name="meter_awal" class="form-control" placeholder="Otomatis terisi" value="<?= $meter_terakhir ?>" readonly>
                    </div>
                     <div class="form-group col-md-3">
                        <label>Meter Akhir</label>
                        <input type="number" name="meter_akhir" class="form-control" placeholder="Masukkan angka meter akhir" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan & Buat Tagihan</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
         <div class="card-header"><h6 class="m-0 font-weight-bold text-primary">Riwayat Penggunaan Anda</h6></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>Periode</th>
                            <th>Meter Awal</th>
                            <th>Meter Akhir</th>
                            <th>Status Tagihan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($penggunaan as $p): ?>
                        <tr>
                            <td><?= $p->bulan ?> <?= $p->tahun ?></td>
                            <td><?= $p->meter_awal ?></td>
                            <td><?= $p->meter_akhir ?></td>
                            <td>
                                <?php if($p->status == 'Lunas'): ?>
                                    <span class="badge badge-success">Lunas</span>
                                <?php elseif($p->status == 'Menunggu Konfirmasi'): ?>
                                    <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Belum Lunas</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($p->status == 'Belum Lunas'): ?>
                                <a href="<?= base_url('pelanggan/penggunaan/edit/' . $p->id_penggunaan) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('pelanggan/penggunaan/hapus/' . $p->id_penggunaan) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini? Tagihan terkait juga akan terhapus.')">Hapus</a>
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