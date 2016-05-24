-- Valentina Studio --
-- MySQL dump --
-- ---------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
-- ---------------------------------------------------------


-- CREATE TABLE "migrations" -------------------------------
CREATE TABLE `migrations` ( 
	`migration` VarChar( 255 ) NOT NULL,
	`batch` Int( 11 ) NOT NULL )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "password_resets" --------------------------
CREATE TABLE `password_resets` ( 
	`email` VarChar( 255 ) NOT NULL,
	`token` VarChar( 255 ) NOT NULL,
	`created_at` Timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "permission_role" --------------------------
CREATE TABLE `permission_role` ( 
	`permission_id` Int( 10 ) UNSIGNED NOT NULL,
	`role_id` Int( 10 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `permission_id`, `role_id` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "permissions" ------------------------------
CREATE TABLE `permissions` ( 
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) NOT NULL,
	`display_name` VarChar( 255 ) NULL,
	`description` VarChar( 255 ) NULL,
	`created_at` Timestamp NULL,
	`updated_at` Timestamp NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `permissions_name_unique` UNIQUE( `name` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 6;
-- ---------------------------------------------------------


-- CREATE TABLE "role_user" --------------------------------
CREATE TABLE `role_user` ( 
	`user_id` Int( 10 ) UNSIGNED NOT NULL,
	`role_id` Int( 10 ) UNSIGNED NOT NULL,
	PRIMARY KEY ( `user_id`, `role_id` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB;
-- ---------------------------------------------------------


-- CREATE TABLE "roles" ------------------------------------
CREATE TABLE `roles` ( 
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 255 ) NOT NULL,
	`display_name` VarChar( 255 ) NULL,
	`description` VarChar( 255 ) NULL,
	`created_at` Timestamp NULL,
	`updated_at` Timestamp NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `roles_name_unique` UNIQUE( `name` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- CREATE TABLE "users" ------------------------------------
CREATE TABLE `users` ( 
	`id` Int( 10 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`name` VarChar( 200 ) NOT NULL,
	`email` VarChar( 255 ) NOT NULL,
	`password` VarChar( 255 ) NOT NULL,
	`status` TinyInt( 4 ) NOT NULL DEFAULT '2',
	`last_login_date` DateTime NULL,
	`phone` VarChar( 64 ) NOT NULL,
	`address` VarChar( 255 ) NOT NULL,
	`avatar` VarChar( 255 ) NULL,
	`attr` Int( 10 ) UNSIGNED NOT NULL DEFAULT '0',
	`added_by` Int( 10 ) UNSIGNED NOT NULL,
	`remember_token` VarChar( 100 ) NULL,
	`created_at` Timestamp NULL,
	`updated_at` Timestamp NULL,
	PRIMARY KEY ( `id` ),
	CONSTRAINT `users_email_unique` UNIQUE( `email` ) )
COLLATE = utf8_unicode_ci
ENGINE = InnoDB
AUTO_INCREMENT = 2;
-- ---------------------------------------------------------


-- Dump data of "migrations" -------------------------------
INSERT INTO `migrations`(`migration`,`batch`) VALUES ( '2014_10_12_000000_create_users_table', '1' );
INSERT INTO `migrations`(`migration`,`batch`) VALUES ( '2014_10_12_100000_create_password_resets_table', '1' );
INSERT INTO `migrations`(`migration`,`batch`) VALUES ( '2016_05_21_100243_entrust_setup_tables', '1' );
-- ---------------------------------------------------------


-- Dump data of "password_resets" --------------------------
-- ---------------------------------------------------------


-- Dump data of "permission_role" --------------------------
INSERT INTO `permission_role`(`permission_id`,`role_id`) VALUES ( '1', '1' );
INSERT INTO `permission_role`(`permission_id`,`role_id`) VALUES ( '2', '1' );
INSERT INTO `permission_role`(`permission_id`,`role_id`) VALUES ( '3', '1' );
INSERT INTO `permission_role`(`permission_id`,`role_id`) VALUES ( '4', '1' );
INSERT INTO `permission_role`(`permission_id`,`role_id`) VALUES ( '5', '1' );
-- ---------------------------------------------------------


-- Dump data of "permissions" ------------------------------
INSERT INTO `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) VALUES ( '1', 'create-user', 'Tạo người dùng', 'Tạo tài khoản người dùng mới trên hệ thống', '2016-05-23 16:06:52', '2016-05-23 16:06:52' );
INSERT INTO `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) VALUES ( '2', 'edit-user', 'Cập nhật thông tin user', 'Cập nhật thông tin user, bao gồm mật khẩu', '2016-05-23 16:06:52', '2016-05-23 16:06:52' );
INSERT INTO `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) VALUES ( '3', 'lock-user', 'Khóa tài khoản', 'Khóa tài khoản người dùng trên hệ thống', '2016-05-23 16:06:52', '2016-05-23 16:06:52' );
INSERT INTO `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) VALUES ( '4', 'unlock-user', 'Mở khóa tài khoản', 'Mở khóa tài khoản', '2016-05-23 16:06:53', '2016-05-23 16:06:53' );
INSERT INTO `permissions`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) VALUES ( '5', 'edit-role', 'Thay đổi quyền', 'Thay đổi/cấp quyền cho các loại tài khoản', '2016-05-23 16:06:53', '2016-05-23 16:06:53' );
-- ---------------------------------------------------------


-- Dump data of "role_user" --------------------------------
INSERT INTO `role_user`(`user_id`,`role_id`) VALUES ( '1', '1' );
-- ---------------------------------------------------------


-- Dump data of "roles" ------------------------------------
INSERT INTO `roles`(`id`,`name`,`display_name`,`description`,`created_at`,`updated_at`) VALUES ( '1', 'admin', 'Quản trị viên', 'Quản trị viên hệ thống', '2016-05-23 16:06:52', '2016-05-23 16:06:52' );
-- ---------------------------------------------------------


-- Dump data of "users" ------------------------------------
INSERT INTO `users`(`id`,`name`,`email`,`password`,`status`,`last_login_date`,`phone`,`address`,`avatar`,`attr`,`added_by`,`remember_token`,`created_at`,`updated_at`) VALUES ( '1', 'Administrator', 'admin@demo.com', '', '3', NULL, '09873465434', '57A Tran Binh Trong', NULL, '0', '0', NULL, '2016-05-23 16:06:52', '2016-05-23 16:41:43' );
-- ---------------------------------------------------------


-- CREATE INDEX "password_resets_email_index" --------------
CREATE INDEX `password_resets_email_index` USING BTREE ON `password_resets`( `email` );
-- ---------------------------------------------------------


-- CREATE INDEX "password_resets_token_index" --------------
CREATE INDEX `password_resets_token_index` USING BTREE ON `password_resets`( `token` );
-- ---------------------------------------------------------


-- CREATE INDEX "permission_role_role_id_foreign" ----------
CREATE INDEX `permission_role_role_id_foreign` USING BTREE ON `permission_role`( `role_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "role_user_role_id_foreign" ----------------
CREATE INDEX `role_user_role_id_foreign` USING BTREE ON `role_user`( `role_id` );
-- ---------------------------------------------------------


-- CREATE INDEX "users_name_index" -------------------------
CREATE INDEX `users_name_index` USING BTREE ON `users`( `name` );
-- ---------------------------------------------------------


-- CREATE LINK "permission_role_permission_id_foreign" -----
ALTER TABLE `permission_role`
	ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY ( `permission_id` )
	REFERENCES `permissions`( `id` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "permission_role_role_id_foreign" -----------
ALTER TABLE `permission_role`
	ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY ( `role_id` )
	REFERENCES `roles`( `id` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "role_user_role_id_foreign" -----------------
ALTER TABLE `role_user`
	ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY ( `role_id` )
	REFERENCES `roles`( `id` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


-- CREATE LINK "role_user_user_id_foreign" -----------------
ALTER TABLE `role_user`
	ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY ( `user_id` )
	REFERENCES `users`( `id` )
	ON DELETE Cascade
	ON UPDATE Cascade;
-- ---------------------------------------------------------


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- ---------------------------------------------------------


