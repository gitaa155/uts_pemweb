# UTS Pem Web

Aplikasi CRUD biodata (tambah, edit, hapus, upload foto) memakai **PHP**, **MySQL**, dan **Bootstrap 5**.

## Tim

<table>
  <tr>
    <td align="center">
      <img src="uploads/seed_arya.jpg" width="200" alt="Muhammad Arya Nanda"><br>
      <b>Lalu Muhammad Arya Nanda</b><br>
      24010110174<br>
      colaborators/ Back-end
    </td>
    <td align="center">
      <img src="uploads/seed_zagita.jpg" width="200" alt="Zagita Suci Rahmadani"><br>
      <b>Zagita Suci Rahmadani</b><br>
      24010110185<br>
      Master/ Front-end
    </td>
  </tr>
</table>

## Struktur Folder

```
uts_pemweb/
├── config/
│   ├── .htaccess        # blokir akses file .sqlite
│   ├── fungsi.php       # fungsi bantu: session, validasi, upload foto
│   └── koneksi.php      # koneksi database (PDO)
├── layout/
│   ├── header.php       # navbar + alert pesan
│   └── footer.php       # footer
├── proses/
│   ├── tambah.php       # proses simpan biodata baru
│   ├── edit.php         # proses update biodata
│   └── hapus.php        # proses hapus biodata
├── uploads/             # foto biodata
├── database.sql         # struktur tabel + data awal
├── index.php            # halaman utama (daftar kartu)
├── tambah.php           # form tambah biodata
├── edit.php             # form edit biodata
└── README.md
```

## Pembagian Tugas

| Bagian | Pengerjaan | File |
|---|---|---|
| Front-end | zagita | `index.php`, `tambah.php`, `edit.php`, `layout/` |
| Back-end | arya| `config/`, `proses/`, `database.sql` |

## Cara Menjalankan

1. Salin folder ke `htdocs` (XAMPP) atau `www` (Laragon), lalu jalankan Apache dan MySQL.
2. Import `database.sql` lewat phpMyAdmin (tab Import) atau HeidiSQL.
3. Buka http://localhost/uts_pemweb/

Butuh PHP 8.1 ke atas.
