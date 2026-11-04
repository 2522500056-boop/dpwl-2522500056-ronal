<?php
$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

require __DIR__ . '/../katalog/header.php';
require __DIR__ . '/../katalog/navbar.php';
?>

<section class="container py-5">
    <div class="row py-3">
        <div class="col-lg-6 m-auto">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-lg-5">
                    <h2 class="h4 text-success mb-3">Formulir Login Penyewa</h2>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $e($error) ?></div>
                    <?php endif; ?>

                    <form action="<?= $e(site_url('auth/login-penyewa')) ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Username *</label>
                            <input type="text" class="form-control" name="user_plg" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password *</label>
                            <input type="password" class="form-control" name="sandi" required>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../katalog/footer.php'; ?>