<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			coreVariables.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

$_LOAD = array( 'promenu'   => 1
				);

$CACHE['promenu'] = array( 'array'				=> 1,
								   'allow_unload'		=> 0,
								   'default_load'		=> 1,
								   'recache_file'		=> IPSLib::getAppDir( 'promenu' ) . '/sources/classes/class_functions.php',
								   'recache_class'		=> 'class_functions',
								   'recache_function'	=> 'recacheMenus'
								   );


/**
* Array for holding reset information
*
* Populate the $_RESET array and ipsRegistry will do the rest
*/
$_RESET = array();
