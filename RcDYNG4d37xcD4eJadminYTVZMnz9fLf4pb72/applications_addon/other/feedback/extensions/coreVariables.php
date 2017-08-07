<?php

/**
 * The Caches!
*/

$CACHE['feedbackIndexStatistics']	= array('array'				=> 1,
											'default_load'		=> 1,
											'recache_file'		=> IPSLib::getAppDir( 'feedback' ) . '/sources/cache.php',
											'recache_class'		=> 'feedbackCache',
											'recache_function'	=> 'indexStatistics'
											);

$CACHE['feedbackTopMembers']		= array(	'array'				=> 1,
											'default_load'		=> 1,
											'recache_file'		=> IPSLib::getAppDir( 'feedback' ) . '/sources/cache.php',
											'recache_class'		=> 'feedbackCache',
											'recache_function'	=> 'topMembers'
											);
?>