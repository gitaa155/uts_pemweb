-- Import file ini lewat phpMyAdmin (tab Import) sebelum menjalankan aplikasi.
CREATE DATABASE IF NOT EXISTS uts_pemweb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE uts_pemweb;

CREATE TABLE IF NOT EXISTS biodata (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nama       VARCHAR(100) NOT NULL,
    deskripsi  TEXT         NOT NULL,
    foto       VARCHAR(255) NOT NULL,
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Data awal (foto ada di folder uploads/)
INSERT INTO biodata (nama, deskripsi, foto) VALUES
('Muhammad Arya Nanda', '24010110174 merupakan master dari UTS ini dengan tugas membuat front-end dan mengirimkannya ke grup', 'seed_arya.jpg'),
('Zagita Suci Rahmadani', 'Dengan NIM 24010110185 merupakan pegawai dan mempunyai tugas mengerjakan back-end pada UTS ini', 'seed_zagita.jpg');
