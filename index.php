<?php
require __DIR__ . '/config/fungsi.php';
$daftar = semuaBiodata($pdo);

require __DIR__ . '/layout/header.php';
?>

<!-- FRONTEND: grid & kartu sesuai gambar soal -->
<div class="row row-cols-1 row-cols-md-3 g-3">
    <!-- Kartu tambah -->
    <div class="col">
        <div class="card h-100 border-0 shadow-sm">
            <a href="tambah.php" class="card-body d-flex align-items-center justify-content-center text-decoration-none" title="Tambah biodata">
                <span class="rounded-circle bg-success bg-gradient text-white d-flex align-items-center justify-content-center display-1"
                      style="width:115px;height:115px">+</span>
            </a>
        </div>
    </div>

    <?php foreach ($daftar as $b): ?>
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                <div class="ratio ratio-1x1">
                    <img src="uploads/<?= e($b['foto']) ?>" class="card-img-top object-fit-cover" alt="Foto <?= e($b['nama']) ?>">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold"><?= e($b['nama']) ?></h5>
                    <p class="card-text small text-secondary"><?= nl2br(e($b['deskripsi'])) ?></p>

                    <div class="mt-auto border-top pt-3 d-flex gap-2">
                        <a href="edit.php?id=<?= $b['id'] ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                        <form action="proses/hapus.php" method="post"
                              onsubmit="return confirm('Yakin ingin menghapus biodata ini?')">
                            <input type="hidden" name="id" value="<?= $b['id'] ?>">
                            <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require __DIR__ . '/layout/footer.php'; ?>
