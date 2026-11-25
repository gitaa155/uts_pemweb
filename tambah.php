<?php
require __DIR__ . '/config/fungsi.php';
$lama = ambilIsianLama();

require __DIR__ . '/layout/header.php';
?>

<!-- FRONTEND: rapikan tampilan form -->
<div class="row justify-content-center"><div class="col-md-6"><div class="card border-0 shadow-sm"><div class="card-body">
<h3 class="mb-3">Tambah Biodata</h3>
<form action="proses/tambah.php" method="post" enctype="multipart/form-data">
    <label for="nama" class="form-label">Nama</label>
    <input type="text" id="nama" name="nama" class="form-control mb-3" maxlength="100" required
           value="<?= e($lama['nama'] ?? '') ?>">

    <label for="deskripsi" class="form-label">Deskripsi (NIM dan tugas)</label>
    <textarea id="deskripsi" name="deskripsi" class="form-control mb-3" rows="4" required><?= e($lama['deskripsi'] ?? '') ?></textarea>

    <label for="foto" class="form-label">Foto (JPG, PNG, WEBP, maks 2 MB)</label>
    <input type="file" id="foto" name="foto" class="form-control mb-3" accept=".jpg,.jpeg,.png,.webp" required
           onchange="this.setCustomValidity(this.files[0]?.size > 2 * 1024 * 1024 ? 'Ukuran foto maksimal 2 MB.' : '')">

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>
</div></div></div></div>

<?php require __DIR__ . '/layout/footer.php'; ?>
