<?php
/**
 * Provisionists, LLC
 * ProMenu 1.0
 * Installation Schematic File
 * Last Updated: $LastChangedDate: 2011-12-04 15:26:00 +12:00 (Sun, 04 Dec 2011) $
 *
 * @author 		$Author: Robert Simons $
 * @copyright	(c) 2011 Provisionists, LLC
 * @package		ProMenu
 * @link		http://www.provisionists.com/
 * @since		4th Dec 2011
 * @version		$Rev: 1 $
 */

$TABLE[] = "CREATE TABLE promenu (
	[promenu_id] [int] IDENTITY(1,1) NOT NULL,
	[promenu_title] [varchar](25) NOT NULL,
	[promenu_description] [varchar](50) NOT NULL,
	[promenu_url] [varchar](255) NOT NULL,
	[promenu_parent_id] [int] NULL DEFAULT 0,
	[promenu_displayorder] [int] NOT NULL,
	[promenu_use_app] [varchar](20) NULL,
	[promenu_app_page] [varchar](20) NULL,
	[promenu_icon] [varchar](255) NULL,
	[promenu_open_new_window] [bit] NOT NULL DEFAULT 0,
	[promenu_left_open] [bit] NOT NULL DEFAULT 0,
	[link_to_app] [bit] NOT NULL DEFAULT 0,
	[promenu_disable_active] [bit] NOT NULL DEFAULT 0,
	[promenu_is_cat] [bit] NOT NULL DEFAULT 0,
	PRIMARY KEY ( promenu_id )
)";

$TABLE[] = "CREATE TABLE promenu_bugs (
	[promenu_bugs_id] [int] IDENTITY(1,1) NOT NULL,
	[promenu_bugs_submitter] [varchar](225) NOT NULL,
	[promenu_bugs_contact] [varchar](50) NOT NULL,
	[promenu_bugs_report] [varchar](255) NOT NULL,
	[promenu_bugs_date] [varchar](255) NULL,
	[promenu_bugs_sent] [int] NOT NULL,
	PRIMARY KEY ( promenu_bugs_id )
)";
?>
