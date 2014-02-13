/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : link

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-02-02 13:34:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `courses`
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('5', 'This is the description of English 1', 'This is the depth information of English 1.', 'Administrator', '2014-01-26 13:19:42', '2014-01-26 16:02:46', '26012014ojMmjCXD1.jpg', 'English 1', '1', '2014-01-01', '2014-12-31');
INSERT INTO `courses` VALUES ('6', 'This is the description of English 2', 'This is the information of English 2', 'Administrator', '2014-01-26 13:25:31', '2014-01-26 13:25:31', '26012014T2SjpY3u2.jpg', 'English 2', '0', '0000-00-00', '0000-00-00');
INSERT INTO `courses` VALUES ('7', 'This is the description of English 3', 'This is the information of English 3', 'Administrator', '2014-01-31 18:41:26', '2014-01-31 19:03:53', '31012014Labi1Dno1.jpg', 'English 3', '1', '2014-01-01', '2014-12-31');

-- ----------------------------
-- Table structure for `course_user`
-- ----------------------------
DROP TABLE IF EXISTS `course_user`;
CREATE TABLE `course_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `course_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `current` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `course_user_course_id_index` (`course_id`),
  KEY `course_user_user_id_index` (`user_id`),
  CONSTRAINT `course_user_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of course_user
-- ----------------------------
INSERT INTO `course_user` VALUES ('2', '5', '1', '0');
INSERT INTO `course_user` VALUES ('15', '7', '1', '0');

-- ----------------------------
-- Table structure for `materials`
-- ----------------------------
DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quiz` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of materials
-- ----------------------------
INSERT INTO `materials` VALUES ('1', 'tes', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'wVQQrIclajk', 'quiz1.json', '5', '2014-01-30 20:35:17', '2014-01-30 20:35:17', '0');
INSERT INTO `materials` VALUES ('2', 'Material 1', 'This is Material 1', 'nyfmd9ZMyIw', 'quiz1.json', '7', '2014-02-01 09:07:08', '2014-02-01 09:07:08', '0');
INSERT INTO `materials` VALUES ('3', 'Material 2', 'This is Material 2', 'rV-jTX4HIzs', 'quiz1.json', '7', '2014-02-01 09:08:00', '2014-02-01 09:08:00', '1');
INSERT INTO `materials` VALUES ('4', 'Material 3', 'This is material 3', 'rV-jTX4HIzs', 'quiz1.json', '7', '2014-02-01 09:08:30', '2014-02-01 09:08:30', '2');

-- ----------------------------
-- Table structure for `material_user`
-- ----------------------------
DROP TABLE IF EXISTS `material_user`;
CREATE TABLE `material_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `material_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `value` int(11) NOT NULL,
  `chance` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `material_user_material_id_index` (`material_id`),
  KEY `material_user_user_id_index` (`user_id`),
  CONSTRAINT `material_user_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `material_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of material_user
-- ----------------------------
INSERT INTO `material_user` VALUES ('7', '2', '1', '0', '2');
INSERT INTO `material_user` VALUES ('8', '3', '1', '0', '2');
INSERT INTO `material_user` VALUES ('9', '4', '1', '0', '2');

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_01_25_191501_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_01_26_031325_create_courses_table', '2');
INSERT INTO `migrations` VALUES ('2014_01_26_033156_add_picture_to_course', '3');
INSERT INTO `migrations` VALUES ('2014_01_26_080332_update_courses', '4');
INSERT INTO `migrations` VALUES ('2014_01_26_105855_create_materials_table', '5');
INSERT INTO `migrations` VALUES ('2014_01_26_150252_add_active_to_courses', '5');
INSERT INTO `migrations` VALUES ('2014_01_27_031607_pivot_material_user_table', '6');
INSERT INTO `migrations` VALUES ('2014_01_27_040034_pivot_course_user_table', '7');
INSERT INTO `migrations` VALUES ('2014_01_27_132842_add_current_to_course_user', '8');
INSERT INTO `migrations` VALUES ('2014_01_27_135946_add_levet_to_material', '9');
INSERT INTO `migrations` VALUES ('2014_01_30_163119_add_date_to_courses', '10');
INSERT INTO `migrations` VALUES ('2014_01_30_171019_remove_week_to_courses', '11');
INSERT INTO `migrations` VALUES ('2014_01_30_171103_remove_week_to_materials', '11');
INSERT INTO `migrations` VALUES ('2014_02_01_025010_add_chance_to_material_user', '12');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `realname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '000000000', 'admin', '$2y$10$62jYIcIj0c5p.StT8yCC2uYxgrK7EileR0.qRKR0/xgD2fezdRU8m', 'Administrator', '000000000', 'admin@link.com', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('2', '000000001', 'koor', '$2y$10$ZDtPUcZ6FEL9dBi8BQPTZ.B1GeEY6ceT9nV/u2HwyhBnSzFq5HTr.', 'Koordinator', '000000000', 'admin@link.com', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('3', '000000002', 'teacher', '$2y$10$LkEHukn1SG6ukjlavcvsWeBabXdYAoHS23LEYL1uwIYqqbd1xEU7G', 'Teacher', '000000000', 'admin@link.com', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('4', '000000003', 'student', '$2y$10$rOBGUwcfGBKb9yptSjC6gu8HuPfst0iz08mdp4Ep8bhPPvGcX7FqC', 'Student', '000000000', 'admin@link.com', '3', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('5', '1130900001', 'dimassrio', '$2y$10$s3.t.kyUWxl2wykjyL7ocub1jbGplWanvoH1gZ7Os5QV/CVgXqXKe', 'dimas satrio', '', 'dimas@dimas.com', '0', '2014-01-25 20:36:51', '2014-01-25 20:36:51');
