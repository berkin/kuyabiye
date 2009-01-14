
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

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
#-- tags
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;


CREATE TABLE `tags`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`tag` VARCHAR(64),
	`stripped_tag` VARCHAR(100),
	`created_by` INTEGER,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `unique_stripped_tag` (`stripped_tag`),
	INDEX `tags_FI_1` (`created_by`),
	CONSTRAINT `tags_FK_1`
		FOREIGN KEY (`created_by`)
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
	`love` TINYINT(1),
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
	`tree_parent` INTEGER  NOT NULL,
	`scope` INTEGER  NOT NULL,
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

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
