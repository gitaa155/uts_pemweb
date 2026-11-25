<?php
require __DIR__ . '/../config/fungsi.php';
wajibPost();

$id   = (int) ($_POST['id'] ?? 0);
$data = cariBiodata($pdo, $id);
if ($data === null) {
    setPesan('danger', 'Biodata tidak ditemukan.');
    alihkan('../index.php');
}

$pdo->prepare('DELETE FROM biodata WHERE id = ?')->execute([$id]);
hapusFoto($data['foto']);

setPesan('success', 'Biodata berhasil dihapus.');
alihkan('../index.php');
