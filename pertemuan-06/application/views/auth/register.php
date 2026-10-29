<?php
$old = $old ?? [];
$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

require __DIR__ . '/../katalog/header.php';
require __DIR__ . '/../katalog/navbar.php';
?>

<section class="container py-5">
    <div class="row py-3">
        <div class="col-lg-8 m-auto">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="h4 text-success mb-3">Formulir Registrasi Penyewa</h2>
                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success"><?= $e($success) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $e($error) ?></div>
                    <?php endif; ?>

                    <form action="<?= $e(site_url('auth/register')) ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username *</label>
                            <input type="text" class="form-control" name="user_plg" maxlength="15" value="<?= $e($old['user_plg'] ?? '') ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password *</label>
                                <input type="password" class="form-control" name="sandi" minlength="8" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password *</label>
                                <input type="password" class="form-control" name="konfirmasi_sandi" minlength="8" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIK *</label>
                            <input type="text" class="form-control" name="nik" maxlength="16" minlength="16" value="<?= $e($old['nik'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" name="nm_lngkp" maxlength="100" value="<?= $e($old['nm_lngkp'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP *</label>
                            <input type="tel" class="form-control" name="no_hp" maxlength="15" value="<?= $e($old['no_hp'] ?? '') ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Alamat Lengkap *</label>
                            <textarea class="form-control" name="almt_lngkp" rows="4" maxlength="300" required><?= $e($old['almt_lngkp'] ?? '') ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../katalog/footer.php'; ?>