<?php
require __DIR__ . '/../config/fungsi.php';
wajibPost();

$form = '../tambah.php';
[$nama, $deskripsi] = validasiTeks($form);

$foto = uploadFoto($form);
if ($foto === null) {
    gagal('Foto wajib dipilih.', $form);
}

$stmt = $pdo->prepare('INSERT INTO biodata (nama, deskripsi, foto) VALUES (?, ?, ?)');
$stmt->execute([$nama, $deskripsi, $foto]);

setPesan('success', 'Biodata berhasil ditambahkan.');
alihkan('../index.php');
