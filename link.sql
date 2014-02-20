/*
Navicat MySQL Data Transfer

Source Server         : LOCAL
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : link

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-02-17 09:16:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `classrooms`
-- ----------------------------
DROP TABLE IF EXISTS `classrooms`;
CREATE TABLE `classrooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of classrooms
-- ----------------------------
INSERT INTO `classrooms` VALUES ('10', 'SI-37-05', '1', '2014-02-14 05:42:36', '2014-02-16 13:13:23', '0');
INSERT INTO `classrooms` VALUES ('11', 'SI-37-04', '1', '2014-02-16 20:04:15', '2014-02-16 20:06:40', '0');
INSERT INTO `classrooms` VALUES ('12', 'SI-37-02', '1', '2014-02-16 20:05:07', '2014-02-16 20:05:07', '0');
INSERT INTO `classrooms` VALUES ('13', 'SI-37-01', '1', '2014-02-16 20:05:32', '2014-02-16 20:05:32', '0');
INSERT INTO `classrooms` VALUES ('14', 'SI-37-06', '1', '2014-02-16 20:05:58', '2014-02-16 20:05:58', '0');
INSERT INTO `classrooms` VALUES ('15', 'SI-37-03', '1', '2014-02-16 20:06:17', '2014-02-16 20:06:17', '0');
INSERT INTO `classrooms` VALUES ('16', 'EL-37-04', '1', '2014-02-16 20:10:57', '2014-02-16 20:10:57', '0');
INSERT INTO `classrooms` VALUES ('17', 'EL-37-02', '1', '2014-02-16 20:11:33', '2014-02-16 20:11:33', '0');
INSERT INTO `classrooms` VALUES ('18', 'EL-37-03', '1', '2014-02-16 20:11:45', '2014-02-16 20:11:45', '0');
INSERT INTO `classrooms` VALUES ('19', 'EL-37-01', '1', '2014-02-16 20:12:04', '2014-02-16 20:12:04', '0');

-- ----------------------------
-- Table structure for `classroom_course`
-- ----------------------------
DROP TABLE IF EXISTS `classroom_course`;
CREATE TABLE `classroom_course` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classroom_id` int(10) unsigned NOT NULL,
  `course_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classroom_course_classroom_id_index` (`classroom_id`),
  KEY `classroom_course_course_id_index` (`course_id`),
  CONSTRAINT `classroom_course_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `classroom_course_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of classroom_course
-- ----------------------------

-- ----------------------------
-- Table structure for `classroom_user`
-- ----------------------------
DROP TABLE IF EXISTS `classroom_user`;
CREATE TABLE `classroom_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classroom_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `classroom_user_classroom_id_index` (`classroom_id`),
  KEY `classroom_user_user_id_index` (`user_id`),
  CONSTRAINT `classroom_user_classroom_id_foreign` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `classroom_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of classroom_user
-- ----------------------------
INSERT INTO `classroom_user` VALUES ('1', '10', '4', '3');
INSERT INTO `classroom_user` VALUES ('5', '10', '7', '2');
INSERT INTO `classroom_user` VALUES ('14', '10', '22', '3');
INSERT INTO `classroom_user` VALUES ('16', '12', '9', '2');
INSERT INTO `classroom_user` VALUES ('17', '13', '10', '2');
INSERT INTO `classroom_user` VALUES ('18', '14', '11', '2');
INSERT INTO `classroom_user` VALUES ('19', '15', '9', '2');
INSERT INTO `classroom_user` VALUES ('21', '11', '7', '2');
INSERT INTO `classroom_user` VALUES ('22', '16', '8', '2');
INSERT INTO `classroom_user` VALUES ('23', '17', '8', '2');
INSERT INTO `classroom_user` VALUES ('24', '18', '8', '2');
INSERT INTO `classroom_user` VALUES ('25', '19', '8', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of courses
-- ----------------------------
INSERT INTO `courses` VALUES ('12', 'In this module 1, you will learn many words related to gadgets. You will listen to good models of pronunciation, proper definitions, and word usages. Go ahead and learn the words. Then, use them in your simple presentations.', 'This module is opened from 17 February 2014 until 25 February 2014. Please review the video material and fulfilling the quiz in order to finish this module. This module have four material that related to gadget.', 'Administrator', '2014-02-16 20:43:47', '2014-02-16 20:57:12', '160220140fR2T9hAx1.jpg', 'Module 1', '1', '2014-02-17', '2014-02-25');

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of course_user
-- ----------------------------
INSERT INTO `course_user` VALUES ('33', '12', '1', '5');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of materials
-- ----------------------------
INSERT INTO `materials` VALUES ('5', 'Vocabulary Exploration - Words related to gadget', '<ol>\r\n<li>Kusmayanti, I. N. et.al. (2012). Communicative English for ICT Engineering Students.Bandung: Dewa Ruchi. </li>\r\n<li>http://www.thefreedictionary.com/ </li>\r\n</ol>', 'http://www.youtube.com/watch?v=oGTny61YQiI&list=PLLo9w-Un-2j3SoKOAtiN1-6rLUMfmZTGL&index=1', 'module1-material1.json', '12', '2014-02-04 02:51:32', '2014-02-04 02:51:32', '0');
INSERT INTO `materials` VALUES ('6', 'Vocabulary Exploration - Gadget', '<ol>\r\n<li>Kusmayanti, I. N. et.al. (2012). Communicative English for ICT Engineering Students.Bandung: Dewa Ruchi.</li>\r\n<li>elllo.org. (2012). About Phone. Retrieved on July 28 th , 2012 from\r\nhttp://www.elllo.org/english/0401/429-Simon-Phone.htm </li>\r\n<li>elllo.org. (2011). Favorite Gadgets. Retrieved on July 4 th  , 2011 from\r\nhttp://www.elllo.org/english/Mixer076/T084-Gadget.htm </li>\r\n</ol>', 'http://www.youtube.com/watch?v=cIeHT61u5b0&list=PLLo9w-Un-2j3SoKOAtiN1-6rLUMfmZTGL&index=2', 'module1-material2.json', '12', '2014-02-04 02:55:12', '2014-02-04 02:55:12', '1');
INSERT INTO `materials` VALUES ('7', 'Vocabulary Exploration - English Idioms in describing object. ', '<ol>\r\n<li>Kusmayanti, I. N. et.al. (2012). Communicative English for ICT Engineering Students.Bandung: Dewa Ruchi.</li>\r\n<li>http://www.thefreedictionary.com/ </li>\r\n</ol>', 'http://www.youtube.com/watch?v=SYN6cv7g1oM&list=PLLo9w-Un-2j3SoKOAtiN1-6rLUMfmZTGL&index=3', 'module1-material3.json', '12', '2014-02-04 02:56:13', '2014-02-04 02:56:13', '2');
INSERT INTO `materials` VALUES ('8', 'Vocabulary Exploration - Pronounciation Practice', '<ol>\r\n<li>Kusmayanti, I. N. et.al. (2012). Communicative English for ICT Engineering Students.Bandung: Dewa Ruchi.</li>\r\n</ol>', 'http://www.youtube.com/watch?v=Otp1jLfpomM&list=PLLo9w-Un-2j3SoKOAtiN1-6rLUMfmZTGL&index=4', '', '12', '2014-02-04 02:59:07', '2014-02-04 02:59:07', '3');
INSERT INTO `materials` VALUES ('9', 'Grammar Time - Proporsional Message', 'Module 2 - Material 5 of English 1 Material', 'kn0cRf8mPeY', '', '9', '2014-02-04 03:17:18', '2014-02-04 03:17:18', '0');
INSERT INTO `materials` VALUES ('10', 'Grammar Time - Verb forms of state function.', 'Module 2 - Material 6 of English 1', 'dHi0ygU_SD4', '', '9', '2014-02-04 03:20:47', '2014-02-04 03:20:47', '1');
INSERT INTO `materials` VALUES ('11', 'Grammar Time - Language Device', 'Module 2 - Material 7 of English 1', 'KZaq-A3ywMc', 'quiz1.json', '9', '2014-02-04 03:21:56', '2014-02-04 03:21:56', '2');
INSERT INTO `materials` VALUES ('12', 'Vocabulary Exploration - Sending a text message.', 'Module 3 - Material 9 of English 1', 'WdtIR2A1CaY', 'quiz1.json', '10', '2014-02-04 03:24:15', '2014-02-04 03:24:15', '0');
INSERT INTO `materials` VALUES ('13', 'Vocabulary Exploration - English idioms in communication', 'Module 3 - Material 10 of English 1', 'FWqcgpKgXlw', 'quiz1.json', '10', '2014-02-04 03:26:01', '2014-02-04 03:26:01', '1');
INSERT INTO `materials` VALUES ('14', 'Vocabulary Exploration - Pronouncing Number', 'Module 3 - Material 14 of English 1', 'kayAvNtuvv8', 'quiz1.json', '10', '2014-02-04 03:27:20', '2014-02-04 03:27:20', '2');
INSERT INTO `materials` VALUES ('15', 'Grammar Time - Language of Procedural Text', 'Module 4 - Material 8 of English 1', 'vbbZSLlsqHQ', 'quiz1.json', '11', '2014-02-04 03:28:32', '2014-02-04 03:28:32', '0');
INSERT INTO `materials` VALUES ('16', 'Grammar Time - Language of Process Text', 'Module 4 - Material 11 of English 1', '9gpnb4VerIw', '5', '11', '2014-02-04 03:30:43', '2014-02-04 03:30:43', '1');
INSERT INTO `materials` VALUES ('17', 'Grammar Time - Verbs Forms in Process Texts', 'Module 4 - Material 12 of English 1', 'WKZBBnLyptI', 'quiz1.json', '11', '2014-02-04 03:32:26', '2014-02-04 03:32:26', '2');
INSERT INTO `materials` VALUES ('18', 'Grammar Time - Language Device to Read Graphs', 'Module 4 - Material 13 of English 1', 'O_uMGQOr-pI', 'quiz1.json', '11', '2014-02-04 03:33:58', '2014-02-04 03:33:58', '3');

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
  `access` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `material_user_material_id_index` (`material_id`),
  KEY `material_user_user_id_index` (`user_id`),
  CONSTRAINT `material_user_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `materials` (`id`) ON DELETE CASCADE,
  CONSTRAINT `material_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of material_user
-- ----------------------------
INSERT INTO `material_user` VALUES ('57', '5', '1', '3', '1', '2014-02-17');
INSERT INTO `material_user` VALUES ('58', '6', '1', '0', '1', '2014-02-17');
INSERT INTO `material_user` VALUES ('59', '7', '1', '0', '1', '2014-02-17');
INSERT INTO `material_user` VALUES ('60', '8', '1', '0', '1', '2014-02-17');

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
INSERT INTO `migrations` VALUES ('2014_02_02_073931_add_date_to_material_user', '13');
INSERT INTO `migrations` VALUES ('2014_02_02_095050_create_classes_table', '14');
INSERT INTO `migrations` VALUES ('2014_02_08_054806_add_class_to_users', '15');
INSERT INTO `migrations` VALUES ('2014_02_08_060204_create_classrooms_table', '15');
INSERT INTO `migrations` VALUES ('2014_02_10_234756_pivot_classroom_user_table', '16');
INSERT INTO `migrations` VALUES ('2014_02_10_235238_add_number_to_user', '17');
INSERT INTO `migrations` VALUES ('2014_02_11_133407_drop_classroom_user', '18');
INSERT INTO `migrations` VALUES ('2014_02_11_134719_add_number_to_classroom', '19');
INSERT INTO `migrations` VALUES ('2014_02_13_192153_pivot_classroom_user_table', '20');
INSERT INTO `migrations` VALUES ('2014_02_13_192527_drop_column_user', '21');
INSERT INTO `migrations` VALUES ('2014_02_13_192944_drop_teacher_from_classrooms', '22');
INSERT INTO `migrations` VALUES ('2014_02_14_053749_add_status_to_classrooms_users', '23');
INSERT INTO `migrations` VALUES ('2014_02_14_095723_pivot_classroom_course_table', '24');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '000000000', 'admin', '$2y$10$62jYIcIj0c5p.StT8yCC2uYxgrK7EileR0.qRKR0/xgD2fezdRU8m', 'Administrator', '000000000', 'admin@link.com', '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `users` VALUES ('2', '000000001', 'koordinator', '$2y$10$r226arvPvnROMgg0Y/rmdeOX/UO56yZFK2H0CK4IjZxisBDEoFWfi', 'Koordinator', '0000000001', 'koordinator@kusmayanti.net', '1', '2014-02-11 14:45:03', '2014-02-11 14:45:03');
INSERT INTO `users` VALUES ('3', '000000002', 'teacher', '$2y$10$K4JL/VelykIPYZaHbUUbXO3eaiJq103F99moWJyg56kc4zDPgbbH2', 'Teacher', '0000000002', 'teacher@kusmayanti.net', '2', '2014-02-11 14:47:05', '2014-02-11 14:47:05');
INSERT INTO `users` VALUES ('4', '113090001', 'dimassrio', '$2y$10$NZsnCGIwGLNte4E2t38bOeLQbpy1HB43rePpd6DozIOKc0GUrLOiq', 'Dimas Satrio', '081227610611', 'dimassrio@outlook.com', '3', '2014-02-11 14:49:01', '2014-02-11 15:38:08');
INSERT INTO `users` VALUES ('7', '000000021', 'flo', '$2a$10$l1YUgMiucC2/kwHwSm9.P.LMOEo2E7g2JTJE.h.PI6RjF15nf5gTm', 'FLO', '000000021', 'flo@telkomuniversity.ac.id', '2', '2014-02-14 00:00:00', '2014-02-14 00:00:00');
INSERT INTO `users` VALUES ('8', '000000022', 'mtn', '$2a$10$3.Bt7vt7ktU8rE/5Yujlj.lN9BZfd7vgll8Y4Mq4YFkVfFiJhPDz.', 'MTN', '000000022', 'mtn@telkomuniversity.ac.id', '2', '2014-02-14 00:00:00', '2014-02-14 00:00:00');
INSERT INTO `users` VALUES ('9', '000000023', 'yli', '$2a$10$vXM3B02CLzC5kHcnU.6jcuQIs8jE.Garrp2T9lgm0ZA2gSUdgiq1e', 'YLI', '000000023', 'yli@telkomuniversity.ac.id', '2', '2014-02-14 00:00:00', '2014-02-14 00:00:00');
INSERT INTO `users` VALUES ('10', '000000024', 'azi', '$2a$10$o86gIo8livbUqYskNY3Q2.6ORBPFJ/upGzMhzLslIUyH/cfCidbL6', 'AZI', '000000024', 'azi@telkomuniversity.ac.id', '2', '2014-02-14 00:00:00', '2014-02-14 00:00:00');
INSERT INTO `users` VALUES ('11', '000000025', 'pre', '$2a$10$WyKIUNWsmdLQfi8LmTTsvuAawrnc.5Qu.xBqdnolOIaUkpR5AdlBe', 'PRE', '000000025', 'pre@telkomuniversity.ac.id', '2', '2014-02-14 00:00:00', '2014-02-14 00:00:00');
INSERT INTO `users` VALUES ('22', '1107101058', 'tsukishiroyuki', '$2y$10$.p7ejpI3T8/7yt/HiLp7ku21QpGK/wOBqbYZhs0WsHhYJMfzZ2Nq2', 'Pratiwi', '085320899788', 'tsukishiro31@gmail.com', '3', '2014-02-16 15:04:29', '2014-02-16 15:04:29');
