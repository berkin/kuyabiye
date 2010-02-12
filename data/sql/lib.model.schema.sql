
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- friends
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `friends`;


CREATE TABLE `friends`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_from` INTEGER,
	`user_to` INTEGER,
	`status` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `friends_FI_1` (`user_from`),
	CONSTRAINT `friends_FK_1`
		FOREIGN KEY (`user_from`)
		REFERENCES `users` (`id`),
	INDEX `friends_FI_2` (`user_to`),
	CONSTRAINT `friends_FK_2`
		FOREIGN KEY (`user_to`)
		REFERENCES `users` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- tags
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;


CREATE TABLE `tags`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`tag` VARCHAR(64),
	`stripped_tag` VARCHAR(100),
	`created_by` INTEGER,
	`lovers` INTEGER default 0,
	`haters` INTEGER default 0,
	`lover_girls` INTEGER default 0,
	`hater_girls` INTEGER default 0,
	`nb_comments` INTEGER default 0,
	`love` TINYINT,
	`sticky` TINYINT,
	`is_on_homepage` TINYINT default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `unique_stripped_tag` (`stripped_tag`),
	INDEX `tags_FI_1` (`created_by`),
	CONSTRAINT `tags_FK_1`
		FOREIGN KEY (`created_by`)
		REFERENCES `users` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- tags_comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tags_comments`;


CREATE TABLE `tags_comments`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`tags_id` INTEGER,
	`users_id` INTEGER,
	`body` TEXT,
	`tree_left` INTEGER  NOT NULL,
	`tree_right` INTEGER  NOT NULL,
	`parent_id` INTEGER  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `tags_comments_FI_1` (`tags_id`),
	CONSTRAINT `tags_comments_FK_1`
		FOREIGN KEY (`tags_id`)
		REFERENCES `tags` (`id`),
	INDEX `tags_comments_FI_2` (`users_id`),
	CONSTRAINT `tags_comments_FK_2`
		FOREIGN KEY (`users_id`)
		REFERENCES `users` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- users
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;


CREATE TABLE `users`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nickname` VARCHAR(50),
	`email` VARCHAR(255),
	`sha1_password` VARCHAR(40),
	`salt` VARCHAR(32),
	`remember_key` VARCHAR(255),
	`avatar` VARCHAR(255),
	`activation_code` INTEGER,
	`first_name` VARCHAR(100),
	`last_name` VARCHAR(100),
	`country` VARCHAR(2),
	`city` VARCHAR(2),
	`gender` TINYINT(1),
	`dob` DATE,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `users_FI_1` (`activation_code`),
	CONSTRAINT `users_FK_1`
		FOREIGN KEY (`activation_code`)
		REFERENCES `activation_codes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- pictures
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pictures`;


CREATE TABLE `pictures`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`name` VARCHAR(255)  NOT NULL,
	`status` TINYINT default 1 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `pictures_FI_1` (`user_id`),
	CONSTRAINT `pictures_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- users_to_tags
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users_to_tags`;


CREATE TABLE `users_to_tags`
(
	`users_id` INTEGER  NOT NULL,
	`tags_id` INTEGER  NOT NULL,
	`love` TINYINT,
	`created_at` DATETIME,
	PRIMARY KEY (`users_id`,`tags_id`),
	CONSTRAINT `users_to_tags_FK_1`
		FOREIGN KEY (`users_id`)
		REFERENCES `users` (`id`),
	INDEX `users_to_tags_FI_2` (`tags_id`),
	CONSTRAINT `users_to_tags_FK_2`
		FOREIGN KEY (`tags_id`)
		REFERENCES `tags` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- conversations
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `conversations`;


CREATE TABLE `conversations`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`owner` INTEGER,
	`sender` INTEGER,
	`recipent` INTEGER,
	`conversation` INTEGER(1) default 0 NOT NULL,
	`inbox` TINYINT(1) default 0 NOT NULL,
	`sent` TINYINT(1) default 0 NOT NULL,
	`is_replied` TINYINT(1) default 0 NOT NULL,
	`is_deleted` TINYINT(1) default 0 NOT NULL,
	`is_read` TINYINT(1) default 0 NOT NULL,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `I_referenced_messages_FK_1_1` (`conversation`),
	INDEX `conversations_FI_1` (`owner`),
	CONSTRAINT `conversations_FK_1`
		FOREIGN KEY (`owner`)
		REFERENCES `users` (`id`),
	INDEX `conversations_FI_2` (`sender`),
	CONSTRAINT `conversations_FK_2`
		FOREIGN KEY (`sender`)
		REFERENCES `users` (`id`),
	INDEX `conversations_FI_3` (`recipent`),
	CONSTRAINT `conversations_FK_3`
		FOREIGN KEY (`recipent`)
		REFERENCES `users` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- messages
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;


CREATE TABLE `messages`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`conversation_id` INTEGER,
	`writer` INTEGER,
	`body` TEXT,
	`html_body` TEXT,
	`read` TINYINT(1) default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `messages_FI_1` (`conversation_id`),
	CONSTRAINT `messages_FK_1`
		FOREIGN KEY (`conversation_id`)
		REFERENCES `conversations` (`conversation`),
	INDEX `messages_FI_2` (`writer`),
	CONSTRAINT `messages_FK_2`
		FOREIGN KEY (`writer`)
		REFERENCES `users` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- activation_codes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `activation_codes`;


CREATE TABLE `activation_codes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(100),
	`total` INTEGER,
	`available` INTEGER,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- articles
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `articles`;


CREATE TABLE `articles`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`author` INTEGER,
	`categories_id` INTEGER default 0 NOT NULL,
	`title` VARCHAR(64),
	`stripped_title` VARCHAR(100),
	`body` TEXT,
	`html_body` TEXT,
	`commentable` TINYINT(1) default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `articles_FI_1` (`author`),
	CONSTRAINT `articles_FK_1`
		FOREIGN KEY (`author`)
		REFERENCES `users` (`id`),
	INDEX `articles_FI_2` (`categories_id`),
	CONSTRAINT `articles_FK_2`
		FOREIGN KEY (`categories_id`)
		REFERENCES `articles_categories` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- articles_categories
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `articles_categories`;


CREATE TABLE `articles_categories`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(64),
	`stripped_title` VARCHAR(100),
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
