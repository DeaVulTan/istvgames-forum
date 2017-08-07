<?php
class app_class_feedback
{
	public function __construct( ipsRegistry $registry )
	{
		/* Load language file */
		$registry->class_localization->loadLanguageFile( array( 'public_global' ), 'feedback' );

		if ( ! $registry->isClassLoaded( 'feedback' ) )
		{
			$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'feedback' ) . "/sources/feedbackLib.php", 'feedbackLib', 'feedback' );
			$registry->setClass('feedback', new $classToLoad( ipsRegistry::instance() ));
		}
	}
}