<?php

//-----------------------------------------------
// (DP34) Mass PM
//-----------------------------------------------
//-----------------------------------------------
// Loader
//-----------------------------------------------
// Author: DawPi
// Site: http://www.ipslink.pl
// Written on: 26 / 05 / 2011
// Updated on: 09 / 01 / 2013
//-----------------------------------------------
// Copyright (C) 2009-2013 DawPi
// All Rights Reserved
//-----------------------------------------------   

class app_class_masspm
{
	public function __construct( ipsRegistry $registry )
	{
		/* Load the library */

        $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'masspm' ) . '/sources/classes/library.php', 'masspmLibrary', 'masspm' );
		$registry->setClass( 'masspmLibrary', new $classToLoad( $registry ) );		
		
        if ( IN_ACP )
		{
			$registry->getClass('class_localization')->loadLanguageFile( array( 'admin_masspm' ), 'masspm' );
		}
	}
} // End of class
