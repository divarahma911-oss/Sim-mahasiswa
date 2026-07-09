-- db_mahasiswa.sql
-- Skema basis data untuk sistem manajemen biodata mahasiswa

CREATE DATABASE IF NOT EXISTS db_mahasiswa;
USE db_mahasiswa;

CREATE TABLE mahasiswa (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    nama         VARCHAR(100) NOT NULL,
    nim          VARCHAR(20)  NOT NULL,
    jk           ENUM('Laki-laki','Perempuan') NOT NULL,
    tempatlahir  VARCHAR(50)  NOT NULL,
    tgllahir     DATE         NOT NULL,
    alamat       TEXT         NOT NULL,
    photo        VARCHAR(150) DEFAULT NULL,
    created_at   TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
);
