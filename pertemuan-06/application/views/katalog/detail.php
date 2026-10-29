<?php
$namaMobil = (string) ($mobil['nm_mobil'] ?? 'Kendaraan');
$status = (string) ($mobil['status_unit'] ?? '');
$statusTersedia = $status === 'tersedia';

require APPPATH . 'views/katalog/header.php';
require APPPATH . 'views/katalog/navbar.php';
?>

<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <?php
                $fotoKendaraan = [];
                foreach (['ft_depan', 'ft_blkg', 'ft_interior'] as $fieldFoto) {
                    $namaFile = trim((string) ($mobil[$fieldFoto] ?? ''));
                    if ($namaFile !== '') {
                        $fotoKendaraan[] = $namaFile;
                    }
                }
                $fotoUtama = $fotoKendaraan[0] ?? null;
                ?>
                <div class="card mb-3">
                    <?php if ($fotoUtama !== null): ?>
                        <img class="card-img img-fluid" src="<?= htmlspecialchars(base_url('uploads/mobil/' . rawurlencode($fotoUtama)), ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($namaMobil, ENT_QUOTES, 'UTF-8') ?>" id="product-detail" style="width: 100%; height: 456px; object-fit: contain;">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center text-muted" style="height: 456px;">Foto kendaraan belum tersedia.</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?= htmlspecialchars($namaMobil, ENT_QUOTES, 'UTF-8') ?></h1>
                        <p class="h3 py-2 detail-harga text-success">Rp <?= number_format((int)$mobil['hrg_hari'], 0, ',', '.') ?> / hari</p>
                        <ul class="list-unstyled">
                            <li><strong>Jenis:</strong> <?= htmlspecialchars((string)($mobil['jns_mobil'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></li>
                            <li><strong>Tahun:</strong> <?= htmlspecialchars((string)$mobil['thn_buat'], ENT_QUOTES, 'UTF-8') ?></li>
                            <li><strong>Transmisi:</strong> <?= htmlspecialchars((string)($mobil['transmisi'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></li>
                            <li><strong>Kapasitas:</strong> <?= (int)$mobil['nkursi'] ?> kursi, <?= (int)$mobil['nbagasi'] ?> bagasi</li>
                        </ul>
                        <h6>Deskripsi Kendaraan</h6>
                        <p><?= nl2br(htmlspecialchars((string)($mobil['cttn_unit'] ?? ''), ENT_QUOTES, 'UTF-8')) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPPATH . 'views/katalog/footer.php'; ?>