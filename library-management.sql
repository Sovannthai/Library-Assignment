/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3333
 Source Server Type    : MySQL
 Source Server Version : 80030
 Source Host           : localhost:3333
 Source Schema         : library-management

 Target Server Type    : MySQL
 Target Server Version : 80030
 File Encoding         : 65001

 Date: 27/04/2024 23:24:20
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cate_id` int(0) NOT NULL,
  `book_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES (1, 1, '770', 'Good for everyone want to know about history war!', '2024-04-23 13:55:18', '2024-04-27 04:58:09', '1');
INSERT INTO `books` VALUES (2, 2, '880', 'Good for young man!', '2024-04-23 13:57:56', '2024-04-27 05:42:05', '1');
INSERT INTO `books` VALUES (4, 4, '990', 'រឿងបង្ហាញពីទំនៀមទម្លាប់ខ្មែរ។', '2024-04-26 05:55:04', '2024-04-27 04:58:21', '1');
INSERT INTO `books` VALUES (5, 4, '991', NULL, '2024-04-27 04:58:32', '2024-04-27 04:58:32', '1');
INSERT INTO `books` VALUES (6, 4, '992', NULL, '2024-04-27 04:58:42', '2024-04-27 04:58:42', '1');
INSERT INTO `books` VALUES (7, 4, '993', NULL, '2024-04-27 04:58:52', '2024-04-27 04:58:52', '1');
INSERT INTO `books` VALUES (8, 4, '995', NULL, '2024-04-27 04:59:01', '2024-04-27 04:59:01', '1');
INSERT INTO `books` VALUES (9, 1, '771', NULL, '2024-04-27 04:59:21', '2024-04-27 04:59:21', '1');
INSERT INTO `books` VALUES (10, 1, '772', NULL, '2024-04-27 04:59:33', '2024-04-27 04:59:33', '1');
INSERT INTO `books` VALUES (11, 1, '773', NULL, '2024-04-27 04:59:54', '2024-04-27 04:59:54', '1');
INSERT INTO `books` VALUES (12, 1, '774', NULL, '2024-04-27 05:00:06', '2024-04-27 05:00:06', '1');
INSERT INTO `books` VALUES (13, 1, '775', NULL, '2024-04-27 05:00:23', '2024-04-27 05:00:23', '1');
INSERT INTO `books` VALUES (16, 2, '881', NULL, '2024-04-27 05:42:16', '2024-04-27 05:42:16', '1');
INSERT INTO `books` VALUES (17, 2, '882', NULL, '2024-04-27 05:42:29', '2024-04-27 05:42:29', '1');
INSERT INTO `books` VALUES (18, 2, '883', NULL, '2024-04-27 05:42:38', '2024-04-27 05:42:38', '1');
INSERT INTO `books` VALUES (19, 2, '884', NULL, '2024-04-27 05:42:51', '2024-04-27 05:42:51', '1');
INSERT INTO `books` VALUES (20, 2, '885', NULL, '2024-04-27 05:43:02', '2024-04-27 05:43:02', '1');
INSERT INTO `books` VALUES (21, 4, '994', NULL, '2024-04-27 06:12:18', '2024-04-27 06:12:18', '1');

-- ----------------------------
-- Table structure for borrows
-- ----------------------------
DROP TABLE IF EXISTS `borrows`;
CREATE TABLE `borrows`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(0) NOT NULL,
  `book_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(0) NOT NULL,
  `borrow_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deposit_amount` decimal(10, 2) NULL DEFAULT NULL,
  `find_amount` decimal(10, 2) NULL DEFAULT NULL,
  `borrow_date` date NULL DEFAULT NULL,
  `due_date` date NULL DEFAULT NULL,
  `return_date` date NULL DEFAULT NULL,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `is_return` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `catelog_id` int(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of borrows
-- ----------------------------
INSERT INTO `borrows` VALUES (1, 1, '[\"1\",\"9\",\"10\"]', 1, '00001', 5.00, 0.00, '2024-04-27', '2024-04-30', NULL, NULL, '1', '2024-04-27 15:04:24', '2024-04-27 15:04:24', 1, NULL);
INSERT INTO `borrows` VALUES (2, 3, '[\"11\",\"12\",\"13\"]', 1, '00002', 7.00, 0.00, '2024-04-27', '2024-04-30', '2024-04-29', 'បានសងវិញហើយ', '0', '2024-04-27 15:04:57', '2024-04-27 15:06:15', 1, NULL);

-- ----------------------------
-- Table structure for catelogs
-- ----------------------------
DROP TABLE IF EXISTS `catelogs`;
CREATE TABLE `catelogs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cate_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cate_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `isbn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `author_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `publisher` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `publishyear` date NULL DEFAULT NULL,
  `publish_edition` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of catelogs
-- ----------------------------
INSERT INTO `catelogs` VALUES (1, 'CAT1', 'History War', 'New York', 'Alin No', 'Jacob', '2024-04-23', 'New York', '2024-04-23 12:49:13', '2024-04-25 12:57:38', '2024-04-23-6627b15b780a1.jpg', '1');
INSERT INTO `catelogs` VALUES (2, 'CAT2', 'Drama Lover Book', 'England', 'Jang Ko', 'Vilaim', '2019-07-23', 'England', '2024-04-23 13:04:45', '2024-04-25 12:59:23', '2024-04-23-6627b1ed50ebf.jpg', '1');
INSERT INTO `catelogs` VALUES (4, 'CAT3', 'ទុំទាវ', 'ខ្មែរ', 'គង់ ប៊ុនឈឿន', 'គង់ ប៊ុនឈឿន', '1965-07-08', 'កម្ពុជា', '2024-04-26 05:53:49', '2024-04-27 04:57:53', '2024-04-26-662b416da63e4.jpg', '1');

-- ----------------------------
-- Table structure for customer_types
-- ----------------------------
DROP TABLE IF EXISTS `customer_types`;
CREATE TABLE `customer_types`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer_types
-- ----------------------------
INSERT INTO `customer_types` VALUES (1, 'Librarian', '2024-04-23 16:34:53', '2024-04-23 16:41:17');
INSERT INTO `customer_types` VALUES (3, 'Student', '2024-04-23 16:42:22', '2024-04-23 16:42:22');
INSERT INTO `customer_types` VALUES (7, 'Another', '2024-04-25 08:11:09', '2024-04-25 08:11:09');
INSERT INTO `customer_types` VALUES (8, 'Teacher', '2024-04-25 09:34:11', '2024-04-25 09:34:11');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `customer_type_id` int(0) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sex` enum('male','female','another') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `dob` date NULL DEFAULT NULL,
  `pob` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `address` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `status` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, '1234', 3, 'Sovann Nai', 'male', '2024-04-25', 'Siem Reap, Cambodia', '017670442', 'P.O.Box 54436, sitra\r\nP.O.Box 54436, sitra', '2024-04-25 01:27:00', '2024-04-27 13:09:10', '1');
INSERT INTO `customers` VALUES (3, '12345', 3, 'Jang Ko', 'male', '2024-04-01', 'Battambang, Cambodia', '017670442', 'P.O.Box 54436, sitra\r\nP.O.Box 54436, sitra', '2024-04-26 05:50:50', '2024-04-27 13:09:11', '1');
INSERT INTO `customers` VALUES (4, '1111', 1, 'Chan Da', 'female', '2006-03-08', 'BMC', '098765433', 'New York', '2024-04-27 05:45:59', '2024-04-27 13:09:08', '1');
INSERT INTO `customers` VALUES (5, '1122', 7, 'Sok Na', 'female', '2001-07-18', 'Siem Reap, Cambodia', '09876543', 'Siem Reap, Cambodia', '2024-04-27 05:46:56', '2024-04-27 13:09:09', '1');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (7, '2024_04_04_171948_create_permission_tables', 2);
INSERT INTO `migrations` VALUES (8, '2024_04_05_172021_add_image_to_users_table', 3);
INSERT INTO `migrations` VALUES (9, '2024_04_23_114842_create_catelog_table', 4);
INSERT INTO `migrations` VALUES (10, '2024_04_23_123000_add_photo_to_catelog_table', 5);
INSERT INTO `migrations` VALUES (11, '2024_04_23_131243_create_book_table', 6);
INSERT INTO `migrations` VALUES (12, '2024_04_23_160830_create_customer_table', 7);
INSERT INTO `migrations` VALUES (13, '2024_04_23_161350_create_customer_type_table', 8);
INSERT INTO `migrations` VALUES (14, '2024_04_25_123546_add_status_to_books_table', 9);
INSERT INTO `migrations` VALUES (15, '2024_04_25_125035_add_status_to_catelogs_table', 10);
INSERT INTO `migrations` VALUES (16, '2024_04_25_130005_add_status_to_customers_table', 11);
INSERT INTO `migrations` VALUES (17, '2024_04_26_054004_create_borrow_table', 12);
INSERT INTO `migrations` VALUES (18, '2024_04_27_055313_add_deleted_at_to_borrows_table', 13);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(0) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint(0) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 1);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'view.dash', 'web', '2024-04-05 13:21:33', '2024-04-05 13:21:33');
INSERT INTO `permissions` VALUES (2, 'view.user', 'web', '2024-04-05 13:46:24', '2024-04-05 13:46:24');
INSERT INTO `permissions` VALUES (3, 'create.user', 'web', '2024-04-05 13:46:24', '2024-04-05 13:46:24');
INSERT INTO `permissions` VALUES (4, 'edit.user', 'web', '2024-04-09 05:51:15', '2024-04-09 05:51:15');
INSERT INTO `permissions` VALUES (5, 'delete.user', 'web', '2024-04-09 05:51:15', '2024-04-09 05:51:15');
INSERT INTO `permissions` VALUES (6, 'view.role', 'web', '2024-04-18 13:28:16', '2024-04-18 13:28:16');
INSERT INTO `permissions` VALUES (7, 'view.emp', 'web', '2024-04-18 13:28:16', '2024-04-18 13:28:16');
INSERT INTO `permissions` VALUES (8, 'create.role', 'web', '2024-04-25 06:06:11', '2024-04-25 06:06:11');
INSERT INTO `permissions` VALUES (9, 'edit.role', 'web', '2024-04-25 06:06:11', '2024-04-25 06:06:11');
INSERT INTO `permissions` VALUES (10, 'delete.role', 'web', '2024-04-25 06:06:11', '2024-04-25 06:06:11');
INSERT INTO `permissions` VALUES (11, 'view.customer', 'web', '2024-04-25 07:24:10', '2024-04-25 07:24:10');
INSERT INTO `permissions` VALUES (12, 'create.customer', 'web', '2024-04-25 07:24:10', '2024-04-25 07:24:10');
INSERT INTO `permissions` VALUES (13, 'edit.customer', 'web', '2024-04-25 07:24:10', '2024-04-25 07:24:10');
INSERT INTO `permissions` VALUES (14, 'delete.customer', 'web', '2024-04-25 07:24:10', '2024-04-25 07:24:10');
INSERT INTO `permissions` VALUES (15, 'view.catelog', 'web', '2024-04-25 07:51:11', '2024-04-25 07:51:11');
INSERT INTO `permissions` VALUES (16, 'view.book', 'web', '2024-04-25 07:57:48', '2024-04-25 07:57:48');
INSERT INTO `permissions` VALUES (17, 'create.catelog', 'web', '2024-04-25 08:02:17', '2024-04-25 08:02:17');
INSERT INTO `permissions` VALUES (18, 'edit.catelog', 'web', '2024-04-25 08:02:17', '2024-04-25 08:02:17');
INSERT INTO `permissions` VALUES (19, 'delete.catelog', 'web', '2024-04-25 08:02:17', '2024-04-25 08:02:17');
INSERT INTO `permissions` VALUES (20, 'create.book', 'web', '2024-04-25 08:02:17', '2024-04-25 08:02:17');
INSERT INTO `permissions` VALUES (21, 'edit.book', 'web', '2024-04-25 08:02:17', '2024-04-25 08:02:17');
INSERT INTO `permissions` VALUES (22, 'delete.book', 'web', '2024-04-25 08:02:17', '2024-04-25 08:02:17');
INSERT INTO `permissions` VALUES (23, 'view.setting', 'web', '2024-04-25 08:09:25', '2024-04-25 08:09:25');
INSERT INTO `permissions` VALUES (24, 'view.borrow', 'web', '2024-04-27 13:12:57', '2024-04-27 13:12:57');
INSERT INTO `permissions` VALUES (25, 'create.borrow', 'web', '2024-04-27 16:14:08', '2024-04-27 16:14:08');
INSERT INTO `permissions` VALUES (26, 'edit.borrow', 'web', '2024-04-27 16:14:08', '2024-04-27 16:14:08');
INSERT INTO `permissions` VALUES (27, 'delete.borrow', 'web', '2024-04-27 16:14:08', '2024-04-27 16:14:08');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(0) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(0) UNSIGNED NOT NULL,
  `role_id` bigint(0) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 2);
INSERT INTO `role_has_permissions` VALUES (2, 2);
INSERT INTO `role_has_permissions` VALUES (3, 2);
INSERT INTO `role_has_permissions` VALUES (4, 2);
INSERT INTO `role_has_permissions` VALUES (5, 2);
INSERT INTO `role_has_permissions` VALUES (6, 2);
INSERT INTO `role_has_permissions` VALUES (8, 2);
INSERT INTO `role_has_permissions` VALUES (9, 2);
INSERT INTO `role_has_permissions` VALUES (10, 2);
INSERT INTO `role_has_permissions` VALUES (11, 2);
INSERT INTO `role_has_permissions` VALUES (12, 2);
INSERT INTO `role_has_permissions` VALUES (13, 2);
INSERT INTO `role_has_permissions` VALUES (14, 2);
INSERT INTO `role_has_permissions` VALUES (15, 2);
INSERT INTO `role_has_permissions` VALUES (16, 2);
INSERT INTO `role_has_permissions` VALUES (17, 2);
INSERT INTO `role_has_permissions` VALUES (18, 2);
INSERT INTO `role_has_permissions` VALUES (19, 2);
INSERT INTO `role_has_permissions` VALUES (20, 2);
INSERT INTO `role_has_permissions` VALUES (21, 2);
INSERT INTO `role_has_permissions` VALUES (22, 2);
INSERT INTO `role_has_permissions` VALUES (23, 2);
INSERT INTO `role_has_permissions` VALUES (24, 2);
INSERT INTO `role_has_permissions` VALUES (26, 2);
INSERT INTO `role_has_permissions` VALUES (1, 22);
INSERT INTO `role_has_permissions` VALUES (2, 22);
INSERT INTO `role_has_permissions` VALUES (6, 22);
INSERT INTO `role_has_permissions` VALUES (11, 22);
INSERT INTO `role_has_permissions` VALUES (15, 22);
INSERT INTO `role_has_permissions` VALUES (16, 22);
INSERT INTO `role_has_permissions` VALUES (23, 22);
INSERT INTO `role_has_permissions` VALUES (24, 22);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (2, 'Admin', 'web', '2024-04-05 13:46:24', '2024-04-09 06:29:50');
INSERT INTO `roles` VALUES (22, 'Librarian', 'web', '2024-04-18 13:28:16', '2024-04-25 07:44:31');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(0) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Ambany Lincon', 'Lincon@gmail.com', 'Lincon@gmail.com', '2024-04-23-66274e761e72b.jpg', NULL, '$2y$10$ryaRNKJ7QXc2Ue3y45qO4utU8laGzj6ZdpWK6T5f9u3JcPtjQ2bvi', 'Nsy6WOba1yThKqO52zXdXkoxjbJT4rl0acHfJijq8D1ge7Xf1f49UpAVyXdp', '2024-04-04 12:08:09', '2024-04-23 06:00:22');
INSERT INTO `users` VALUES (7, 'Testing', 'test12', 'test@gmail.com', '2024-04-25-662a7b6e3e94b.jpg', NULL, '$2y$12$QEmCUMeHNVhWsn0YqOkLrO7AhV3kq9e/21cEW.LwA24h5GuKqGEeW', NULL, '2024-04-25 15:49:02', '2024-04-25 15:49:02');

SET FOREIGN_KEY_CHECKS = 1;
