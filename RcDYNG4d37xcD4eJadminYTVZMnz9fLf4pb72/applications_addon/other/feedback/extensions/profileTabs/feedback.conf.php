<?php

$CONFIG['plugin_name']		= IPSLib::getAppTitle('feedback');
$CONFIG['plugin_lang_bit']	= 'feedback_public_global';
$CONFIG['plugin_key']		= 'feedback';

$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'feedback' ) . "/sources/feedbackLib.php", 'feedbackLib', 'feedback' );
$feedbackLib = new $classToLoad( $this->registry );

$enabled = 0;

if ( $this->registry->permissions->check( 'view', $feedbackLib->getPermissions() ) )
{
	$enabled = 1;
}

$CONFIG['plugin_enabled']	= $enabled;
$CONFIG['plugin_order']		= 11;