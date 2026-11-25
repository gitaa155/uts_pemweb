<?php // Dipanggil setelah config/fungsi.php di-require ?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTS Pem Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- FRONTEND: navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">UTS Pem Web</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <div class="navbar-nav">
                <a class="nav-link active" href="index.php">Home</a>
                <a class="nav-link" href="#">Features</a>
                <a class="nav-link" href="#">Muhammad Arya Nanda</a>
                <a class="nav-link disabled" aria-disabled="true">24010110174</a>
            </div>
        </div>
    </div>
</nav>

<main class="container py-4">
    <?php if ($pesan = ambilPesan()): ?>
        <div class="alert alert-<?= e($pesan['tipe']) ?> alert-dismissible fade show" role="alert">
            <?= e($pesan['teks']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    <?php endif; ?>
