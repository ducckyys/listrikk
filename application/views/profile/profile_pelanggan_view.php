<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"> <?= $this->session->flashdata('success'); ?> </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('error'); ?> </div>
    <?php endif; ?>

    <div class="card shadow mb-4 col-md-8">
        <div class="card-header"> Form Edit Profil </div>
        <div class="card-body">
            <form action="<?= base_url('profile/update') ?>" method="post">
                <div class="form-group">
                    <label>ID Pelanggan</label>
                    <input type="text" class="form-control" value="PLG<?= $user->id_user; ?>" readonly>
                </div>
                 <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $user->username; ?>" required>
                </div>
                 <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $user->nama_lengkap; ?>" required>
                </div>
                <div class="form-group">
                    <label>Nomor KWH</label>
                    <input type="text" name="nomor_kwh" class="form-control" value="<?= $user->nomor_kwh; ?>" required>
                </div>
                 <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required><?= $user->alamat; ?></textarea>
                </div>
                 <div class="form-group">
                    <label>Pilih Tarif</label>
                    <select name="id_tarif" class="form-control" required>
                        <?php foreach($tarif as $t): ?>
                        <option value="<?= $t->id_tarif; ?>" <?= $t->id_tarif == $user->id_tarif ? 'selected' : '' ?>>
                            <?= $t->daya; ?> (Rp <?= number_format($t->tarif_per_kwh); ?> / KWH)
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <hr>
                <p class="text-muted">Kosongkan password jika tidak ingin mengubahnya.</p>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="konfirmasi_password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>