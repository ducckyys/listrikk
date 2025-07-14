<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('superadmin/petugas/tambah') ?>" class="btn btn-primary mb-3">Tambah Petugas</a>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"> <?= $this->session->flashdata('success'); ?> </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('error'); ?> </div>
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
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($petugas as $p): ?>
                        <tr>
                            <td><?= strtoupper($p->nama_level) == 'SUPERADMIN' ? 'ADM' : 'USR' ?><?= $p->id_user ?></td>
                            <td><?= $p->nama_lengkap ?></td>
                            <td><?= $p->username ?></td>
                            <td>
                                <span class="badge <?= $p->nama_level == 'superadmin' ? 'badge-dark' : 'badge-info' ?>"><?= strtoupper($p->nama_level) ?></span>
                            </td>
                            <td>
                                <?php if($p->id_user != $this->session->userdata('id_user')): ?>
                                <a href="<?= base_url('superadmin/petugas/edit/' . $p->id_user) ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= base_url('superadmin/petugas/hapus/' . $p->id_user) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Delete</a>
                                <?php else: ?>
                                <a href="<?= base_url('superadmin/petugas/edit/' . $p->id_user) ?>" class="btn btn-sm btn-warning">Edit</a>
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