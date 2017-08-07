<?php

/**
 * Installer SQL
*/

$TABLE[] = "CREATE TABLE feedback (
		id			MEDIUMINT( 8 )	UNSIGNED NOT NULL AUTO_INCREMENT ,
		date		INT( 10 )		UNSIGNED NOT NULL ,
		sender		MEDIUMINT( 8 )	UNSIGNED NOT NULL ,
		receiver	MEDIUMINT( 8 )	UNSIGNED NOT NULL ,
		ip			VARCHAR( 16 )	NOT NULL ,
		note		TEXT			NOT NULL ,
		score		TINYINT( 1 )	NOT NULL ,
		link_type	varchar( 1 )	NOT NULL DEFAULT 't',
		link		INT( 10 )		NOT NULL,
		type		TINYINT( 1 )	NOT NULL,
		conv		TINYINT( 1 )	NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`,`date`,`type`),
  KEY `sender` (`sender`,`date`)
);";

$TABLE[] = "ALTER TABLE members ADD feedb_percent TINYINT(3) NOT NULL DEFAULT '-1'";

/* 1.1.1 */
$TABLE[] = "ALTER TABLE members ADD feedb_pos SMALLINT(5) NOT NULL DEFAULT '0'";
$TABLE[] = "ALTER TABLE members ADD feedb_neg SMALLINT(5) NOT NULL DEFAULT '0'";
$TABLE[] = "ALTER TABLE members ADD feedb_neu SMALLINT(5) NOT NULL DEFAULT '0'";
?>