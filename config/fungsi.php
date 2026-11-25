<?php
// Kumpulan fungsi bantu. Cukup require file ini, koneksi ($pdo) & session ikut aktif.

session_start();
require_once __DIR__ . '/koneksi.php';

const FOLDER_UPLOAD = __DIR__ . '/../uploads/';
const MAKS_UKURAN   = 2 * 1024 * 1024; // 2 MB

// Escape teks sebelum ditampilkan ke HTML (mencegah XSS).
function e(?string $teks): string
{
    return htmlspecialchars($teks ?? '', ENT_QUOTES, 'UTF-8');
}

// ---------- Data biodata ----------

function semuaBiodata(PDO $pdo): array
{
    return $pdo->query('SELECT * FROM biodata ORDER BY id ASC')->fetchAll();
}

function cariBiodata(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare('SELECT * FROM biodata WHERE id = ?');
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

// ---------- Pesan (alert) & isian lama ----------

function setPesan(string $tipe, string $teks): void
{
    $_SESSION['pesan'] = ['tipe' => $tipe, 'teks' => $teks]; // tipe: success | danger
}

// Pesan hanya tampil satu kali.
function ambilPesan(): ?array
{
    $pesan = $_SESSION['pesan'] ?? null;
    unset($_SESSION['pesan']);
    return $pesan;
}

// Isian form sebelumnya, supaya tidak hilang ketika validasi gagal.
function ambilIsianLama(): array
{
    $lama = $_SESSION['lama'] ?? [];
    unset($_SESSION['lama']);
    return $lama;
}

// ---------- Alur halaman ----------

function alihkan(string $tujuan): never
{
    header('Location: ' . $tujuan);
    exit;
}

// Validasi gagal: simpan pesan + isian, lalu kembali ke form.
function gagal(string $teks, string $tujuan): never
{
    setPesan('danger', $teks);
    $_SESSION['lama'] = [
        'nama'      => $_POST['nama'] ?? '',
        'deskripsi' => $_POST['deskripsi'] ?? '',
    ];
    alihkan($tujuan);
}

function wajibPost(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        alihkan('../index.php');
    }
    // PHP mengosongkan $_POST jika kiriman melebihi post_max_size.
    if (empty($_POST) && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
        setPesan('danger', 'Ukuran file terlalu besar, maksimal 2 MB.');
        alihkan('../index.php');
    }
}

// Mengembalikan [nama, deskripsi] yang sudah valid.
function validasiTeks(string $tujuanGagal): array
{
    $nama      = trim($_POST['nama'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');

    if ($nama === '' || $deskripsi === '') {
        gagal('Nama dan deskripsi wajib diisi.', $tujuanGagal);
    }
    if (strlen($nama) > 100) {
        gagal('Nama maksimal 100 karakter.', $tujuanGagal);
    }
    return [$nama, $deskripsi];
}

// ---------- Foto ----------

// Menyimpan foto dan mengembalikan nama filenya. null = tidak ada foto yang dipilih.
function uploadFoto(string $tujuanGagal): ?string
{
    $file  = $_FILES['foto'] ?? null;
    $error = $file['error'] ?? UPLOAD_ERR_NO_FILE;

    if ($error === UPLOAD_ERR_NO_FILE) {
        return null;
    }
    if ($error === UPLOAD_ERR_INI_SIZE || $error === UPLOAD_ERR_FORM_SIZE || $file['size'] > MAKS_UKURAN) {
        gagal('Ukuran foto maksimal 2 MB.', $tujuanGagal);
    }
    if ($error !== UPLOAD_ERR_OK) {
        gagal('Foto gagal diunggah, silakan coba lagi.', $tujuanGagal);
    }

    // Cek isi file, bukan cuma ekstensinya.
    $tipeBoleh = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    $info      = @getimagesize($file['tmp_name']);
    $ekstensi  = $tipeBoleh[$info['mime'] ?? ''] ?? null;

    if ($ekstensi === null) {
        gagal('Foto harus berupa JPG, PNG, atau WEBP.', $tujuanGagal);
    }

    $namaFile = bin2hex(random_bytes(8)) . '.' . $ekstensi;
    if (!move_uploaded_file($file['tmp_name'], FOLDER_UPLOAD . $namaFile)) {
        gagal('Foto gagal disimpan. Periksa izin folder uploads.', $tujuanGagal);
    }
    return $namaFile;
}

function hapusFoto(string $namaFile): void
{
    $path = FOLDER_UPLOAD . basename($namaFile);
    if (is_file($path)) {
        unlink($path);
    }
}
