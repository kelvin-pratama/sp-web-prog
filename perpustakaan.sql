/*
 Navicat Premium Data Transfer

 Source Server         : local-dev
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : perpustakaan

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 06/07/2024 20:20:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id_admin` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------

-- ----------------------------
-- Table structure for buku
-- ----------------------------
DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku`  (
  `id_buku` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isbn` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_penulis` int UNSIGNED NOT NULL,
  `id_penerbit` int UNSIGNED NOT NULL,
  `id_kategori` int UNSIGNED NOT NULL,
  `tahun_terbit` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sinopsis` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` int NOT NULL,
  `foto_sampul` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_buku`) USING BTREE,
  INDEX `fk_id_penulis_in_buku-table`(`id_penulis` ASC) USING BTREE,
  INDEX `fk_id_penerbit_in_buku-table`(`id_penerbit` ASC) USING BTREE,
  INDEX `fk_id_kategori_in_buku-table`(`id_kategori` ASC) USING BTREE,
  CONSTRAINT `fk_id_kategori_in_buku-table` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_penerbit_in_buku-table` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_penulis_in_buku-table` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id_penulis`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of buku
-- ----------------------------

-- ----------------------------
-- Table structure for detail_peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `detail_peminjaman`;
CREATE TABLE `detail_peminjaman`  (
  `id_peminjaman` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_buku` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah_pinjam` int UNSIGNED NOT NULL,
  INDEX `fk_id_peminjaman_in_detil_peminjaman-table`(`id_peminjaman` ASC) USING BTREE,
  INDEX `fk_id_buku_in_detil_peminjaman-table`(`id_buku` ASC) USING BTREE,
  CONSTRAINT `fk_id_buku_in_detil_peminjaman-table` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_peminjaman_in_detil_peminjaman-table` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detail_peminjaman
-- ----------------------------

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id_kategori` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman`  (
  `id_peminjaman` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nisn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_harus_kembali` date NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  `status_pinjam` enum('Pinjam','Kembali') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`) USING BTREE,
  INDEX `fk_nisn_in_peminjaman-table`(`nisn` ASC) USING BTREE,
  INDEX `fk_id_admin_in_peminjaman-table`(`id_admin` ASC) USING BTREE,
  CONSTRAINT `fk_id_admin_in_peminjaman-table` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_nisn_in_peminjaman-table` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------

-- ----------------------------
-- Table structure for penerbit
-- ----------------------------
DROP TABLE IF EXISTS `penerbit`;
CREATE TABLE `penerbit`  (
  `id_penerbit` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_penerbit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kota` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_penerbit`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penerbit
-- ----------------------------

-- ----------------------------
-- Table structure for pengadaan
-- ----------------------------
DROP TABLE IF EXISTS `pengadaan`;
CREATE TABLE `pengadaan`  (
  `id_pengadaan` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_pengadaan` date NOT NULL,
  `id_buku` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `asal_buku` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_pengadaan`) USING BTREE,
  INDEX `fk_id_buku_in_pengadaan-table`(`id_buku` ASC) USING BTREE,
  INDEX `fk_id_admin`(`id_admin` ASC) USING BTREE,
  CONSTRAINT `fk_id_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_buku_in_pengadaan-table` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengadaan
-- ----------------------------

-- ----------------------------
-- Table structure for pengembalian
-- ----------------------------
DROP TABLE IF EXISTS `pengembalian`;
CREATE TABLE `pengembalian`  (
  `id_kembali` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_pinjam` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_admin` int UNSIGNED NOT NULL,
  `denda` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_kembali`) USING BTREE,
  INDEX `fk_id_pinjam_in_pengembalian-table`(`id_pinjam` ASC) USING BTREE,
  INDEX `fk_id_admin_in_pengembalian-table`(`id_admin` ASC) USING BTREE,
  CONSTRAINT `fk_id_admin_in_pengembalian-table` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_id_pinjam_in_pengembalian-table` FOREIGN KEY (`id_pinjam`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengembalian
-- ----------------------------

-- ----------------------------
-- Table structure for penulis
-- ----------------------------
DROP TABLE IF EXISTS `penulis`;
CREATE TABLE `penulis`  (
  `id_penulis` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama_penulis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_penulis`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penulis
-- ----------------------------

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa`  (
  `nisn` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_siswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jkel` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tempat_lahir` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_hp` varchar(14) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_siswa` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`nisn`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of siswa
-- ----------------------------

-- ----------------------------
-- Table structure for temp_peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `temp_peminjaman`;
CREATE TABLE `temp_peminjaman`  (
  `id_temp` int UNSIGNED NOT NULL,
  `id_buku` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah_pinjam` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id_temp`) USING BTREE,
  INDEX `fk_id_buku_in_temp_peminjaman-table`(`id_buku` ASC) USING BTREE,
  CONSTRAINT `fk_id_buku_in_temp_peminjaman-table` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of temp_peminjaman
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
