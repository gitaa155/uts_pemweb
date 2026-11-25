<?php
// Koneksi database memakai PDO.
// Default: MySQL (XAMPP). Untuk laptop tanpa MySQL, jalankan dengan DB_DRIVER=sqlite.

$driver = getenv('DB_DRIVER') ?: 'mysql';

$host = 'localhost';
$db   = 'uts_pemweb';
$user = 'root';
$pass = '';

$opsi = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    if ($driver === 'sqlite') {
        $pdo = new PDO('sqlite:' . __DIR__ . '/uts_pemweb.sqlite', null, null, $opsi);
        $pdo->exec("CREATE TABLE IF NOT EXISTS biodata (
            id         INTEGER PRIMARY KEY AUTOINCREMENT,
            nama       VARCHAR(100) NOT NULL,
            deskripsi  TEXT NOT NULL,
            foto       VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )");
    } else {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, $opsi);
    }
} catch (PDOException $e) {
    die('Koneksi database gagal: ' . htmlspecialchars($e->getMessage()));
}
