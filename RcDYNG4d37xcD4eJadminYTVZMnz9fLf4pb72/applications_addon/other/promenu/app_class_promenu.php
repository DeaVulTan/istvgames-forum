<?php 
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			app_class_promenu.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */
  
class app_class_promenu 
{ 
 /** 
 * Registry Object Shortcuts 
 */ 
 protected $registry; 
 protected $DB; 
 protected $settings; 
 protected $request; 
 protected $lang; 
 
 /** 
 * Constructor 
 */ 
 function __construct( ipsRegistry $registry ) 
 { 
  $this->registry = $registry; 
  $this->DB       = $this->registry->DB(); 
  $this->settings =& $this->registry->fetchSettings(); 
  $this->request  =& $this->registry->fetchRequest(); 
  $this->cache    = $this->registry->cache(); 
  $this->caches   =& $this->registry->cache()->fetchCaches(); 
  $this->lang     = $this->registry->getClass('class_localization'); 
  $this->member   = $this->registry->member(); 
  $this->memberData =& $this->registry->member()->fetchMemberData(); 
 
  if ( IN_ACP ) 
  { 
   try 
   { 
    if( !$this->registry->isClassLoaded( 'class_bugs' ) ) 
    { 
    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir("promenu")."/sources/classes/class_bugs.php", 'class_bugs', 'promenu' ); 
    $this->registry->setClass( 'class_bugs', new $classToLoad( $registry ) ); 
    } 
    if( !$this->registry->isClassLoaded( 'class_menus' ) ) 
    { 
    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir("promenu")."/sources/classes/class_menus.php", 'class_menus', 'promenu' ); 
    $this->registry->setClass( 'class_menus', new $classToLoad( $registry ) ); 
    } 
    if( !$this->registry->isClassLoaded( 'class_perms' ) ) 
    { 
    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir("promenu")."/sources/classes/class_perms.php", 'class_perms', 'promenu' ); 
    $this->registry->setClass( 'class_perms', new $classToLoad( $registry ) ); 
    } 
    if( !$this->registry->isClassLoaded( 'class_functions' ) ) 
    { 
    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir("promenu")."/sources/classes/class_functions.php", 'class_functions', 'promenu' ); 
    $this->registry->setClass( 'class_functions', new $classToLoad( $registry ) ); 
    } 
    if( !$this->registry->isClassLoaded( 'class_groups' ) ) 
    { 
    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir("promenu")."/sources/classes/class_groups.php", 'class_groups', 'promenu' ); 
    $this->registry->setClass( 'class_groups', new $classToLoad( $registry ) ); 
    } 
   } 
   catch( Exception $error ) 
   { 
    IPS_exception_error( $error ); 
   } 
  } 
  else 
  { 
   try 
   { 
     
     
    if( !$this->registry->isClassLoaded( 'class_perms' ) ) 
    {  
    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir("promenu")."/sources/classes/class_perms.php", 'class_perms', 'promenu' ); 
    $this->registry->setClass( 'class_perms', new $classToLoad( $registry ) ); 
    } 
    if( !$this->registry->isClassLoaded( 'class_functions' ) ) 
    { 
    $classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir("promenu")."/sources/classes/class_functions.php", 'class_functions', 'promenu' ); 
    $this->registry->setClass( 'class_functions', new $classToLoad( $registry ) ); 
    } 
   } 
   catch( Exception $error ) 
   { 
    IPS_exception_error( $error ); 
   } 
  }   
 } 
 
 public function afterOutputInit( ipsRegistry $registry ) 
 { 
 } 
}