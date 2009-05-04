
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
	`status` TINYINT,
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
	`created_at` DATETIME,
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
	`first_name` VARCHAR(100),
	`last_name` VARCHAR(100),
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
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
#-- messages
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;


CREATE TABLE `messages`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sender` INTEGER,
	`recipent` INTEGER,
	`sender_folder` TINYINT default 1 NOT NULL,
	`recipent_folder` TINYINT default 0 NOT NULL,
	`title` VARCHAR(255),
	`body` TEXT,
	`conversation` INTEGER,
	`read` TINYINT(1) default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `messages_FI_1` (`sender`),
	CONSTRAINT `messages_FK_1`
		FOREIGN KEY (`sender`)
		REFERENCES `users` (`id`),
	INDEX `messages_FI_2` (`recipent`),
	CONSTRAINT `messages_FK_2`
		FOREIGN KEY (`recipent`)
		REFERENCES `users` (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
