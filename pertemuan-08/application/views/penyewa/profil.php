<?php
$e = static function ($value): string { return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); };
$profil = $profil ?? [];
require __DIR__ . '/../katalog/header.php';
require __DIR__ . '/../katalog/navbar.php';
?>

<section class="container py-5">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="h4 text-success mb-3">Informasi Profil Penyewa</h2>
                    <?php if (!empty($flash)): ?><div class="alert alert-success"><?= $e($flash) ?></div><?php endif; ?>
                    <?php if (!empty($error)): ?><div class="alert alert-danger"><?= $e($error) ?></div><?php endif; ?>

                    <form action="<?= $e(site_url('penyewa/profil')) ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?= $e($profil['user_plg'] ?? '') ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK *</label>
                            <input type="text" class="form-control" name="nik" value="<?= $e($profil['nik'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" name="nm_lngkp" value="<?= $e($profil['nm_lngkp'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP *</label>
                            <input type="tel" class="form-control" name="no_hp" value="<?= $e($profil['no_hp'] ?? '') ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Alamat Lengkap *</label>
                            <textarea class="form-control" name="almt_lngkp" rows="3" required><?= $e($profil['almt_lngkp'] ?? '') ?></textarea>
                        </div>

                        <h3 class="h5 text-success mb-3">Ganti Password (Opsional)</h3>
                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" class="form-control" name="password_saat_ini">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" name="password_baru">
                        </div>

                        <h3 class="h5 text-success mb-3">Dokumen Identitas</h3>
                        <div class="mb-3">
                            <label class="form-label">Foto KTP</label>
                            <input type="file" class="form-control" name="ft_ktp" accept="image/*">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Foto SIM A</label>
                            <input type="file" class="form-control" name="ft_sim_a" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../katalog/footer.php'; ?>