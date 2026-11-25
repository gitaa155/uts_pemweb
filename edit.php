<?php
require __DIR__ . '/config/fungsi.php';

$data = cariBiodata($pdo, (int) ($_GET['id'] ?? 0));
if ($data === null) {
    setPesan('danger', 'Biodata tidak ditemukan.');
    alihkan('index.php');
}
$isian = ambilIsianLama() + $data; // isian lama (jika validasi gagal) menimpa data dari database

require __DIR__ . '/layout/header.php';
?>

<!-- FRONTEND: rapikan tampilan form -->
<div class="row justify-content-center"><div class="col-md-6"><div class="card border-0 shadow-sm"><div class="card-body">
<h3 class="mb-3">Edit Biodata</h3>
<form action="proses/edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <label for="nama" class="form-label">Nama</label>
    <input type="text" id="nama" name="nama" class="form-control mb-3" maxlength="100" required
           value="<?= e($isian['nama']) ?>">

    <label for="deskripsi" class="form-label">Deskripsi (NIM dan tugas)</label>
    <textarea id="deskripsi" name="deskripsi" class="form-control mb-3" rows="4" required><?= e($isian['deskripsi']) ?></textarea>

    <img src="uploads/<?= e($data['foto']) ?>" class="img-thumbnail mb-2" width="150" alt="Foto saat ini">
    <label for="foto" class="form-label d-block">Ganti foto (kosongkan jika tidak diganti)</label>
    <input type="file" id="foto" name="foto" class="form-control mb-3" accept=".jpg,.jpeg,.png,.webp"
           onchange="this.setCustomValidity(this.files[0]?.size > 2 * 1024 * 1024 ? 'Ukuran foto maksimal 2 MB.' : '')">

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>
</div></div></div></div>

<?php require __DIR__ . '/layout/footer.php'; ?>
