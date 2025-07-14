<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4 col-md-8">
        <div class="card-header">
            Form Edit Pelanggan
        </div>
        <div class="card-body">
            <form action="<?= base_url('superadmin/pelanggan/edit/' . $pelanggan->id_user) ?>" method="post">
                
                <input type="hidden" name="id_user" value="<?= $pelanggan->id_user; ?>">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $pelanggan->nama_lengkap; ?>" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $pelanggan->username; ?>" required>
                </div>
                <div class="form-group">
                    <label>Nomor KWH</label>
                    <input type="text" name="nomor_kwh" class="form-control" value="<?= $pelanggan->nomor_kwh; ?>" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= $pelanggan->alamat; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Pilih Tarif</label>
                    <select name="id_tarif" class="form-control" required>
                        <option value="">-- Pilih Tarif --</option>
                        <?php foreach($tarif as $t): ?>
                        <option value="<?= $t->id_tarif; ?>" <?= $t->id_tarif == $pelanggan->id_tarif ? 'selected' : '' ?>>
                            <?= $t->daya; ?> (Rp <?= number_format($t->tarif_per_kwh); ?> / KWH)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <hr>
                <a href="<?= base_url('superadmin/pelanggan') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>