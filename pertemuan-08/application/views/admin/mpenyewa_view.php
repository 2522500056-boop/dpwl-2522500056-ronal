<?php
require APPPATH . '/views/templates/header.php';
require APPPATH . '/views/templates/sidebar.php';
?>
<?php
$e = static fn($v): string => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
$username = $username ?? '';
$mode = $mode ?? null;
$penyewa = $penyewa ?? [];
$penyewa_dipilih = $penyewa_dipilih ?? null;
$flash = $flash ?? null;
$error = $error ?? null;
$isForm = in_array($mode, ['tambah', 'ubah'], true);
$isEdit = $mode === 'ubah';
$userDipilih = $penyewa_dipilih['user_plg'] ?? '';
$formAction = $isEdit
    ? site_url('admin/penyewa/ubah/' . rawurlencode($userDipilih))
    : site_url('admin/penyewa/tambah');
$flashClass = (($flash['type'] ?? '') === 'success') ? 'alert-success' : 'alert-danger';
$fotoUrl = static fn(?string $f): string => base_url('uploads/penyewa/' . rawurlencode((string) $f));
?>
<div class="content-wrapper">
<section class="content-header">
<h1>Manajemen Penyewa <small>Kelola data penyewa kendaraan</small></h1>
<ol class="breadcrumb">
<li><a href="<?= $e(site_url('admin')) ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<li class="active">Manajemen Penyewa</li>
</ol>
</section>

<section class="content">
<?php if (!empty($flash)): ?>
<div class="alert <?= $flashClass ?> alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa <?= (($flash['type'] ?? '') === 'success') ? 'fa-check' : 'fa-warning' ?>"></i>
<?= $e($flash['message'] ?? '') ?>
</div>
<?php endif; ?>

<div class="box">
<div class="box-header">
<h3 class="box-title">Data Penyewa</h3>
<div class="box-tools">
<a href="<?= $e(site_url('admin/penyewa/tambah')) ?>" class="btn btn-primary btn-sm">
<i class="fa fa-plus"></i> Tambah Penyewa
</a>
</div>
</div>
<div class="box-body">
<div class="table-responsive">
<table id="penyewaTable" class="table table-bordered table-striped js-data-table">
<thead>
<tr>
<th>No</th>
<th>Username</th>
<th>NIK</th>
<th>Nama Lengkap</th>
<th>No. HP</th>
<th>Alamat</th>
<th class="no-sort">KTP</th>
<th class="no-sort">SIM A</th>
<th class="no-sort">Aksi</th>
</tr>
</thead>
<tbody>
<?php foreach ($penyewa as $no => $p): ?>
<tr>
<td><?= $no + 1 ?></td>
<td><?= $e($p['user_plg']) ?></td>
<td><?= $e($p['nik']) ?></td>
<td><?= $e($p['nm_lngkp']) ?></td>
<td><?= $e($p['no_hp']) ?></td>
<td><?= $e($p['almt_lngkp']) ?></td>
<td>
<?php if (!empty($p['ft_ktp'])): ?>
<a href="<?= $e($fotoUrl($p['ft_ktp'])) ?>" target="_blank" rel="noopener">
<img src="<?= $e($fotoUrl($p['ft_ktp'])) ?>" alt="KTP <?= $e($p['user_plg']) ?>"
class="img-thumbnail" style="width:80px;height:55px;object-fit:cover;">
</a>
<?php else: ?>
<span class="text-muted">-</span>
<?php endif; ?>
</td>
<td>
<?php if (!empty($p['ft_sim_a'])): ?>
<a href="<?= $e($fotoUrl($p['ft_sim_a'])) ?>" target="_blank" rel="noopener">
<img src="<?= $e($fotoUrl($p['ft_sim_a'])) ?>" alt="SIM A <?= $e($p['user_plg']) ?>"
class="img-thumbnail" style="width:80px;height:55px;object-fit:cover;">
</a>
<?php else: ?>
<span class="text-muted">-</span>
<?php endif; ?>
</td>
<td style="white-space:nowrap;">
<a href="<?= $e(site_url('admin/penyewa/ubah/' . rawurlencode($p['user_plg']))) ?>"
class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-edit"></i> Edit</a>
<form method="post"
action="<?= $e(site_url('admin/penyewa/hapus/' . rawurlencode($p['user_plg']))) ?>"
style="display:inline;">
<button type="submit" class="btn btn-danger btn-sm" title="Hapus"
onclick="return confirm('Yakin ingin menghapus penyewa ini?');">
<i class="fa fa-trash"></i> Hapus
</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
<th>No</th><th>Username</th><th>NIK</th><th>Nama Lengkap</th><th>No. HP</th>
<th>Alamat</th><th>KTP</th><th>SIM A</th><th>Aksi</th>
</tr>
</tfoot>
</table>
</div>
</div>
</div>

<?php if ($error !== null): ?>
<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<i class="fa fa-warning"></i> <?= $e($error) ?>
</div>
<?php endif; ?>

<?php if ($isForm): ?>
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title"><?= $isEdit ? 'Ubah Data Penyewa' : 'Tambah Penyewa' ?></h3>
</div>
<form role="form" method="post" enctype="multipart/form-data" action="<?= $e($formAction) ?>">
<div class="box-body">
<div class="form-group">
<label for="user_plg">Username</label>
<input type="text" class="form-control" id="user_plg" name="user_plg" maxlength="15"
pattern="[A-Za-z0-9._-]{1,15}"
value="<?= $e($penyewa_dipilih['user_plg'] ?? '') ?>" <?= $isEdit ? 'readonly' : 'required' ?>>
</div>
<div class="form-group">
<label for="sandi">Password<?= $isEdit ? ' (opsional)' : '' ?></label>
<input type="password" class="form-control" id="sandi" name="sandi" minlength="8"
maxlength="72" autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
<?php if ($isEdit): ?>
<p class="help-block">Kosongkan jika password tidak ingin diubah.</p>
<?php else: ?>
<p class="help-block">Minimal 8 karakter. Disimpan dalam bentuk hash.</p>
<?php endif; ?>
</div>
<div class="form-group">
<label for="konfirmasi_sandi">Konfirmasi Password</label>
<input type="password" class="form-control" id="konfirmasi_sandi" name="konfirmasi_sandi"
maxlength="72" autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
</div>
<div class="form-group">
<label for="nik">NIK</label>
<input type="text" class="form-control" id="nik" name="nik" maxlength="16"
inputmode="numeric" pattern="[0-9]{16}"
value="<?= $e($penyewa_dipilih['nik'] ?? '') ?>" required>
<p class="help-block">Tepat 16 digit angka.</p>
</div>
<div class="form-group">
<label for="nm_lngkp">Nama Lengkap</label>
<input type="text" class="form-control" id="nm_lngkp" name="nm_lngkp" maxlength="100"
value="<?= $e($penyewa_dipilih['nm_lngkp'] ?? '') ?>" required>
</div>
<div class="form-group">
<label for="no_hp">Nomor HP</label>
<input type="text" class="form-control" id="no_hp" name="no_hp" maxlength="15"
value="<?= $e($penyewa_dipilih['no_hp'] ?? '') ?>" required>
</div>
<div class="form-group">
<label for="almt_lngkp">Alamat Lengkap</label>
<textarea class="form-control" id="almt_lngkp" name="almt_lngkp" rows="3" maxlength="300"
required><?= $e($penyewa_dipilih['almt_lngkp'] ?? '') ?></textarea>
</div>
<hr>
<h4>Berkas Identitas</h4>
<?php foreach (['ft_ktp' => 'Foto KTP', 'ft_sim_a' => 'Foto SIM A'] as $field => $label): ?>
<div class="form-group">
<label for="<?= $e($field) ?>"><?= $e($label) ?></label>
<input type="file" class="form-control" id="<?= $e($field) ?>" name="<?= $e($field) ?>"
accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
<p class="help-block">JPG, JPEG, PNG, atau WEBP; maksimal 5 MB.</p>
<div class="photo-preview" style="margin-top:10px;">
<?php if (!empty($penyewa_dipilih[$field]) && is_string($penyewa_dipilih[$field])): ?>
<p class="help-block">Foto saat ini:</p>
<img class="img-thumbnail" alt="<?= $e($label) ?> saat ini"
src="<?= $e($fotoUrl($penyewa_dipilih[$field])) ?>"
style="width:180px;height:120px;object-fit:cover;">
<p class="help-block">Kosongkan jika tidak ingin menggantinya.</p>
<?php else: ?>
<p class="help-block">Belum ada foto tersimpan.</p>
<?php endif; ?>
<div class="new-photo-preview" style="display:none;margin-top:8px;">
<p class="help-block">Pratinjau foto yang dipilih:</p>
<img class="img-thumbnail new-photo-image" alt="Pratinjau <?= $e($label) ?>"
style="width:180px;height:120px;object-fit:cover;">
</div>
</div>
</div>
<?php endforeach; ?>
</div>
<div class="box-footer">
<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
<a href="<?= $e(site_url('admin/penyewa')) ?>" class="btn btn-default">
<i class="fa fa-times"></i> Batal
</a>
</div>
</form>
</div>
<?php endif; ?>
</section>
</div>
<script>
(function() {
'use strict';
document.querySelectorAll('input[type="file"][name^="ft_"]').forEach(function(input) {
var box = input.closest('.form-group');
var preview = box ? box.querySelector('.new-photo-preview') : null;
var image = preview ? preview.querySelector('.new-photo-image') : null;
var prev = null;
if (!preview || !image) { return; }
input.addEventListener('change', function() {
if (prev) { URL.revokeObjectURL(prev); prev = null; }
var f = input.files && input.files.length ? input.files[0] : null;
if (!f || ['image/jpeg', 'image/png', 'image/webp'].indexOf(f.type) === -1 ||
f.size < 1 || f.size > 5 * 1024 * 1024) {
preview.style.display = 'none';
image.removeAttribute('src');
return;
}
prev = URL.createObjectURL(f);
image.src = prev;
preview.style.display = 'block';
});
});
})();
</script>
<?php
require APPPATH . '/views/templates/footer.php';
?>
