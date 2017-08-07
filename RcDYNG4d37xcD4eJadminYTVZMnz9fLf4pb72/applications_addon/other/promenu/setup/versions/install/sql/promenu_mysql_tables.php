<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			promenu_mysql_tables.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

$TABLE[] = "CREATE TABLE promenu (
	promenu_id						int(10) NOT NULL auto_increment,
	promenu_title					varchar(225) NOT NULL,
	promenu_description				varchar(255) NULL,
	promenu_url						varchar(255) NOT NULL,
	promenu_parent_id				int(10) NOT NULL DEFAULT 0,
	promenu_displayorder			int(10) NOT NULL,
	promenu_use_app				    varchar(20),
	promenu_app_page			    varchar(20),
	promenu_icon					varchar(255) NULL,
	promenu_open_new_window			int(1) NOT NULL DEFAULT 0,
	promenu_disable_active			int(1) NOT NULL DEFAULT 0,
	promenu_is_cat					int(1) NOT NULL DEFAULT 0,
	promenu_left_open				int(1) NOT NULL DEFAULT 0,
	link_to_app						int(1) NOT NULL DEFAULT 0,
	promenu_disable_desc_hover		int(1) NOT NULL DEFAULT 0,
	promenu_data_tooltip			int(1) NOT NULL DEFAULT 0,
	promenu_view_menu				text NULL,
	promenu_view_override			int(1) NOT NULL DEFAULT 0,
	promenu_as_cat					int(1) NOT NULL DEFAULT 0,
	promenu_title_image				int(1) NOT NULL DEFAULT 0,
	promenu_use_block 				int(1) NOT NULL DEFAULT 0,
	promenu_block_content			mediumtext,
	promenu_group_mega				int(1) NOT NULL DEFAULT 0,
	promenu_new_row					int(1) NOT NULL DEFAULT 0,
  	promenu_group_id 				int(10) NOT NULL DEFAULT 1,
  	promenu_group_key 				varchar(50) NOT NULL DEFAULT 'primary_menus',
	PRIMARY KEY (promenu_id)
);";

$TABLE[] = "CREATE TABLE promenu_bugs (
	promenu_bugs_id					int(10) NOT NULL auto_increment,
	promenu_bugs_submitter			varchar(225) NOT NULL,
	promenu_bugs_contact			varchar(50) NOT NULL,
	promenu_bugs_report				text NOT NULL,
	promenu_bugs_date				varchar(255) NOT NULL,
	promenu_bugs_sent				int(10) NOT NULL,
	PRIMARY KEY (promenu_bugs_id)
);";

$TABLE[] = "CREATE TABLE promenu_groups (
	promenu_group_id				int(10) NOT NULL auto_increment,
	promenu_group_title				varchar(225) NOT NULL,
	promenu_group_description		varchar(255) NOT NULL,
	promenu_group_displayorder		int(10) NOT NULL,
	promenu_group_key				varchar(50) NOT NULL,
	promenu_group_mega				int(1) NOT NULL DEFAULT 0,
	PRIMARY KEY (promenu_group_id)
);";
?>
