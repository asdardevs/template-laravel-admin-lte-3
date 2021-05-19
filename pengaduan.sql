/*
 Navicat Premium Data Transfer

 Source Server         : Laragon
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : pengaduan

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 19/05/2021 09:51:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for access_menus
-- ----------------------------
DROP TABLE IF EXISTS `access_menus`;
CREATE TABLE `access_menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of access_menus
-- ----------------------------
INSERT INTO `access_menus` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `access_menus` VALUES (4, 2, 1, NULL, NULL);
INSERT INTO `access_menus` VALUES (5, 3, 1, NULL, NULL);

-- ----------------------------
-- Table structure for access_sub_menus
-- ----------------------------
DROP TABLE IF EXISTS `access_sub_menus`;
CREATE TABLE `access_sub_menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sub_menu_id` int(11) NOT NULL,
  `sub_role_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of access_sub_menus
-- ----------------------------
INSERT INTO `access_sub_menus` VALUES (1, 1, 1, NULL, NULL);
INSERT INTO `access_sub_menus` VALUES (2, 2, 1, NULL, NULL);
INSERT INTO `access_sub_menus` VALUES (6, 6, 1, NULL, NULL);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for meetings
-- ----------------------------
DROP TABLE IF EXISTS `meetings`;
CREATE TABLE `meetings`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `kelas_id` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meetings
-- ----------------------------
INSERT INTO `meetings` VALUES (1, 'Pertemuan 1', 2, '2021-04-24 03:34:41', '2021-04-24 03:36:04');
INSERT INTO `meetings` VALUES (3, 'Pertemuan 2', 2, '2021-04-24 03:36:18', '2021-04-24 03:36:18');
INSERT INTO `meetings` VALUES (4, 'Pertemuan 3', 2, '2021-04-24 03:36:24', '2021-04-24 03:36:24');
INSERT INTO `meetings` VALUES (5, 'Pertemuan 5', 3, '2021-04-24 13:59:01', '2021-04-24 13:59:01');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `urut` int(11) NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Beranda', 'beranda', 'nav-icon fas  fa-chalkboard-teacher', 1, '1', NULL, NULL);
INSERT INTO `menus` VALUES (2, 'Master Data', NULL, 'nav-icon fas fa-chart-pie', 2, '1', NULL, NULL);
INSERT INTO `menus` VALUES (3, 'Pengaturan', NULL, 'nav-icon fas fa-user-cog', 3, '1', NULL, NULL);
INSERT INTO `menus` VALUES (5, 'Profil', 'profil', 'nav-icon fas fa-user', 5, '1', '2021-04-22 13:48:38', '2021-04-22 13:48:38');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_09_28_000317_create_roles_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_09_28_000429_create_menus_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_09_28_000510_create_sub_menus_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_09_28_000603_create_access_menus_table', 1);
INSERT INTO `migrations` VALUES (8, '2020_09_28_000649_create_access_sub_menus_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_role` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Admin', NULL, NULL);
INSERT INTO `roles` VALUES (2, 'Operator', NULL, NULL);
INSERT INTO `roles` VALUES (3, 'Mahasiswa', NULL, NULL);

-- ----------------------------
-- Table structure for sub_menus
-- ----------------------------
DROP TABLE IF EXISTS `sub_menus`;
CREATE TABLE `sub_menus`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NULL DEFAULT NULL,
  `sub` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sub_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `is_active` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `urut_sub` int(11) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sub_menus
-- ----------------------------
INSERT INTO `sub_menus` VALUES (1, 3, 'Menu', 'menu', '1', 2, NULL, NULL);
INSERT INTO `sub_menus` VALUES (2, 3, 'Sub Menu', 'sub-menu', '1', 3, NULL, NULL);
INSERT INTO `sub_menus` VALUES (6, 2, 'User', 'user', '1', 2, '2021-05-19 01:16:26', '2021-05-19 01:16:26');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kelas_id` int(11) NULL DEFAULT NULL,
  `profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `role_id` int(11) NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Zulkiplih', NULL, NULL, 'admin', '$2y$10$ZalCDE6FX5Jb0BKhtWh6yeQzz.owZSYVt50LGLXYMf.69QqEe7XqC', NULL, NULL, 1, NULL, NULL, NULL);
INSERT INTO `users` VALUES (4, 'Joko Widodo', NULL, NULL, '0009088003', '$2y$10$ZalCDE6FX5Jb0BKhtWh6yeQzz.owZSYVt50LGLXYMf.69QqEe7XqC', NULL, '0009088003 1620305284.jpg', 2, NULL, '2021-04-23 02:39:02', '2021-05-06 12:48:04');
INSERT INTO `users` VALUES (5, 'Gibran', NULL, NULL, '1529040004', '$2y$10$ZalCDE6FX5Jb0BKhtWh6yeQzz.owZSYVt50LGLXYMf.69QqEe7XqC', 2, '1529040004 1619317530.png', 3, NULL, '2021-04-24 04:08:48', '2021-04-25 02:25:30');

SET FOREIGN_KEY_CHECKS = 1;
