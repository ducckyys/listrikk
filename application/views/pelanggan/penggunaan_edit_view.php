<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (validation_errors()): ?>
    <div class="alert alert-danger"> <?= validation_errors(); ?> </div>
    <?php endif; ?>

    <div class="card shadow mb-4 col-md-8">
        <div class="card-header"><h6 class="m-0 font-weight-bold text-primary">Form Edit Penggunaan</h6></div>
        <div class="card-body">
            <form action="<?= base_url('pelanggan/penggunaan/proses_edit/' . $penggunaan->id_penggunaan) ?>" method="post">
                <div class="form-group">
                    <label>Bulan</label>
                    <input type="text" name="bulan" class="form-control" value="<?= $penggunaan->bulan ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Tahun</label>
                    <input type="number" name="tahun" class="form-control" value="<?= $penggunaan->tahun ?>" readonly>
                </div>
                 <div class="form-group">
                    <label>Meter Awal</label>
                    <input type="number" name="meter_awal" class="form-control" value="<?= $penggunaan->meter_awal ?>" readonly>
                </div>
                 <div class="form-group">
                    <label>Meter Akhir</label>
                    <input type="number" name="meter_akhir" class="form-control" value="<?= $penggunaan->meter_akhir ?>" required>
                </div>
                <a href="<?= base_url('pelanggan/penggunaan') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>