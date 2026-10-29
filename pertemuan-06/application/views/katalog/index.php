<?php require APPPATH . 'views/katalog/header.php'; ?>
<?php require APPPATH . 'views/katalog/navbar.php'; ?>

<section class="bg-light" id="katalog">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Katalog Kendaraan</h1>
                <p>Lihat informasi kendaraan, spesifikasi, dan harga sewa sebelum menentukan pilihan.</p>
            </div>
        </div>
        <div class="row">
            <?php if (empty($daftarMobil)): ?>
                <div class="col-12">
                    <div class="alert alert-info" role="status">Belum ada data kendaraan yang dapat ditampilkan.</div>
                </div>
            <?php else: ?>
                <?php foreach ($daftarMobil as $mobil): ?>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="katalog-foto">
                                <?php if (!empty($mobil['ft_depan'])): ?>
                                    <a href="<?= htmlspecialchars(site_url('katalog/detail/' . rawurlencode($mobil['no_plat'])), ENT_QUOTES, 'UTF-8') ?>">
                                        <img src="<?= htmlspecialchars(base_url('uploads/mobil/' . rawurlencode($mobil['ft_depan'])), ENT_QUOTES, 'UTF-8') ?>" class="card-img-top" alt="<?= htmlspecialchars($mobil['nm_mobil'], ENT_QUOTES, 'UTF-8') ?>">
                                    </a>
                                <?php else: ?>
                                    <div class="katalog-foto-kosong"><span>Foto kendaraan belum tersedia</span></div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h2>
                                    <a class="text-decoration-none text-dark" href="<?= htmlspecialchars(site_url('katalog/detail/' . rawurlencode($mobil['no_plat'])), ENT_QUOTES, 'UTF-8') ?>">
                                        <?= htmlspecialchars($mobil['nm_mobil'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </h2>
                                <p class="mb-1"><strong>Jenis:</strong> <?= htmlspecialchars($mobil['jns_mobil'] ?? '-', ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="mb-1"><strong>Tahun:</strong> <?= htmlspecialchars((string)$mobil['thn_buat'], ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="mb-1"><strong>Transmisi:</strong> <?= htmlspecialchars($mobil['transmisi'] ?? '-', ENT_QUOTES, 'UTF-8') ?></p>
                                <p class="mb-1"><strong>Kapasitas:</strong> <?= (int)$mobil['nkursi'] ?> kursi, <?= (int)$mobil['nbagasi'] ?> bagasi</p>
                                <p class="h5 text-success mt-3">Rp <?= number_format((int)$mobil['hrg_hari'], 0, ',', '.') ?> / hari</p>
                                <p class="mb-3">
                                    <strong>Status:</strong>
                                    <?php if ($mobil['status_unit'] === 'tersedia'): ?>
                                        <span class="badge bg-success">Tersedia</span>
                                    <?php elseif ($mobil['status_unit'] === 'disewa'): ?>
                                        <span class="badge bg-warning text-dark">Sedang disewa</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tidak tersedia</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require APPPATH . 'views/katalog/footer.php'; ?>