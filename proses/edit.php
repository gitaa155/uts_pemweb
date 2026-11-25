<?php
require __DIR__ . '/../config/fungsi.php';
wajibPost();

$id   = (int) ($_POST['id'] ?? 0);
$data = cariBiodata($pdo, $id);
if ($data === null) {
    setPesan('danger', 'Biodata tidak ditemukan.');
    alihkan('../index.php');
}

$form = '../edit.php?id=' . $id;
[$nama, $deskripsi] = validasiTeks($form);
$fotoBaru = uploadFoto($form); // boleh kosong: foto lama tetap dipakai

$stmt = $pdo->prepare('UPDATE biodata SET nama = ?, deskripsi = ?, foto = ? WHERE id = ?');
$stmt->execute([$nama, $deskripsi, $fotoBaru ?? $data['foto'], $id]);

if ($fotoBaru !== null) {
    hapusFoto($data['foto']);
}

setPesan('success', 'Biodata berhasil diperbarui.');
alihkan('../index.php');
