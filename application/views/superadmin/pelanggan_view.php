<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('superadmin/pelanggan/tambah') ?>" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"> <?= $this->session->flashdata('success'); ?> </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>No. KWH</th>
                            <th>Daya</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pelanggan as $p): ?>
                        <tr>
                            <td>PLG<?= $p->id_user ?></td>
                            <td><?= $p->nama_lengkap ?></td>
                            <td><?= $p->username ?></td>
                            <td><?= $p->nomor_kwh ?></td>
                            <td><?= $p->daya ?></td>
                            <td>
                                <a href="<?= base_url('superadmin/pelanggan/edit/' . $p->id_user) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('superadmin/pelanggan/hapus/' . $p->id_user) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>