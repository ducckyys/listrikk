<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if (validation_errors()): ?>
        <div class="alert alert-danger" role="alert">
            <?= validation_errors(); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4 col-md-8">
        <div class="card-header">
            Form Tambah Pelanggan Baru
        </div>
        <div class="card-body">
            <form action="<?= base_url('superadmin/pelanggan/tambah') ?>" method="post">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= set_value('nama_lengkap'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= set_value('username'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Nomor KWH</label>
                    <input type="text" name="nomor_kwh" class="form-control" value="<?= set_value('nomor_kwh'); ?>" required>
                </div>
                 <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= set_value('alamat'); ?></textarea>
                </div>
                 <div class="form-group">
                    <label>Pilih Tarif</label>
                    <select name="id_tarif" class="form-control" required>
                        <option value="">-- Pilih Tarif --</option>
                        <?php foreach($tarif as $t): ?>
                        <option value="<?= $t->id_tarif; ?>">
                            <?= $t->daya; ?> (Rp <?= number_format($t->tarif_per_kwh); ?> / KWH)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <a href="<?= base_url('superadmin/pelanggan') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>