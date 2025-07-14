<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrasi Akun - Listrik Pascabayar</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">

</head>

<body class="bg-custom-auth">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                            </div>

                            <?php if (validation_errors()): ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>

                            <form class="user" action="<?= base_url('register/proses') ?>" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= set_value('nama_lengkap'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="username" placeholder="Username" value="<?= set_value('username'); ?>" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Kata Sandi" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="konfirmasi_password" placeholder="Ulangi Kata Sandi" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nomor_kwh" placeholder="Nomor KWH" value="<?= set_value('nomor_kwh'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="alamat" class="form-control form-control-user" placeholder="Alamat Lengkap" required><?= set_value('alamat'); ?></textarea>
                                </div>
                                <div class="form-group">
                                     <select name="id_tarif" class="form-control" style="font-size: .8rem; border-radius: 10rem; height: 50px; padding-left: 15px;" required>
                                        <option value="">-- Pilih Tarif Listrik Anda --</option>
                                        <?php foreach($tarif as $t): ?>
                                        <option value="<?= $t->id_tarif; ?>">
                                            <?= $t->daya; ?> (Rp <?= number_format($t->tarif_per_kwh); ?> / KWH)
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Daftarkan Akun
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth') ?>">Sudah punya akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>