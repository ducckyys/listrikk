<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4 col-md-8">
        <div class="card-body">
            <form action="<?= base_url('superadmin/petugas/edit/' . $user->id_user) ?>" method="post">
                <input type="hidden" name="id_user" value="<?= $user->id_user; ?>">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $user->nama_lengkap; ?>" required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $user->username; ?>" required>
                </div>
                <hr>
                <p class="text-muted">Kosongkan password jika tidak ingin mengubahnya.</p>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <a href="<?= base_url('superadmin/petugas') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>