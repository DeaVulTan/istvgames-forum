<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			promenu_mysql_inserts.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

 $INSERT[] = "INSERT INTO promenu_groups (`promenu_group_id`, `promenu_group_title`, `promenu_group_description`, `promenu_group_displayorder`, `promenu_group_key`) VALUES
(1, 'Primary Navigation Menus', 'Primary Replacement Navigation', 2, 'primary_menus')";
 
 $INSERT[] = "ALTER TABLE promenu_groups AUTO_INCREMENT= 21";
?>
