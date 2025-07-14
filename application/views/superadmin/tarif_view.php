<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4 col-lg-6">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Tarif</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('superadmin/tarif/tambah') ?>" method="post">
                <div class="form-group">
                    <label>Daya (Contoh: 900VA)</label>
                    <input type="text" name="daya" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tarif per KWH</label>
                    <input type="number" name="tarif_per_kwh" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tarif Listrik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Tarif</th>
                            <th>Daya</th>
                            <th>Tarif / KWH</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($tarif as $t): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $t->kode_tarif; ?></td>
                            <td><?= $t->daya; ?></td>
                            <td>Rp <?= number_format($t->tarif_per_kwh, 0, ',', '.'); ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal<?= $t->id_tarif ?>">Edit</button>
                                <a href="<?= base_url('superadmin/tarif/hapus/' . $t->id_tarif) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php foreach($tarif as $t): ?>
<div class="modal fade" id="editModal<?= $t->id_tarif ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Tarif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('superadmin/tarif/update'); ?>" method="post">
          <div class="modal-body">
            <input type="hidden" name="id_tarif" value="<?= $t->id_tarif; ?>">
            <div class="form-group">
                <label>Daya</label>
                <input type="text" name="daya" class="form-control" value="<?= $t->daya; ?>" required>
            </div>
            <div class="form-group">
                <label>Tarif per KWH</label>
                <input type="number" name="tarif_per_kwh" class="form-control" value="<?= $t->tarif_per_kwh; ?>" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>