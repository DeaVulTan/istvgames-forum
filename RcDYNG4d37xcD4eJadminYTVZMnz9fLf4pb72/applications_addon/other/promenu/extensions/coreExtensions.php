<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			coreExtensions.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

$_PERM_CONFIG = array( 'Menu' );

class promenuPermMappingMenu
{
	

	private $mappings = array( 'view'	=>	'perm_view' );
	
	private $perm_names = array( 'view'	=>	'Display Menu' );
	
	private $perm_colours = array( 'view'	=>	'#fff0f2' );
	
	
	
	public function getMapping()
	{
		return $this->mappings;
	}
	
	public function getPermNames()
	{
		return $this->perm_names;
	}
	
	public function getPermColors()
	{
		return $this->perm_colours;
	}
	
	
}
