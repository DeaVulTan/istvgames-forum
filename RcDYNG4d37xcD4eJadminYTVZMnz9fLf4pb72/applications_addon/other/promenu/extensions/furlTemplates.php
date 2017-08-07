<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			furlTemplates.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

if ( !defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

$_SEOTEMPLATES = array(

	'app=promenu'   => array( 'app'		      => 'promenu',
							  'allowRedirect' => 0,
							  'out'           => array( '#app=promenu(&|$)#i', 'promenu/$1' ),
							  'in'            => array( 'regex'   => '#^/promenu/(/|$|\?)#i',
												        'matches' => array( array( 'app', 'promenu' ) ) ) ),


	'app=forums'    => array( 'app'		      => 'forums',
							  'allowRedirect' => 0,
							  'out'           => array( '#app=forums(&|$)#i', 'index/$1' ),
							  'in'            => array( 'regex'   => '#^/index/(/|$|\?)#i',
												        'matches' => array( array( 'app', 'forums' ) ) ) ),
														

									
	'app=members'   => array( 'app'		      => 'members',
							  'allowRedirect' => 0,
							  'out'           => array( '#app=members(&|$)#i', 'members/$1' ),
							  'in'            => array( 'regex'   => '#^/members/(/|$|\?)#i',
												        'matches' => array( array( 'app', 'members' ) ) ) ),


	'app=awards'    => array( 'app'		      => 'awards',
							  'allowRedirect' => 0,
							  'out'           => array( '#app=awards(&|$)#i', 'awards/$1' ),
							  'in'            => array( 'regex'   => '#^/awards/(/|$|\?)#i',
												        'matches' => array( array( 'app', 'awards' ) ) ) ),

	'help'  => array( 
						'app'			=> 'core',
						'allowRedirect' => 0,
						'out'			=> array( '#app=core((&|&amp;)module=help)?#i', 'help/' ),
						'in'			=> array( 
													'regex'		=> "#/help/(/|$|\?)#i",
													'matches'	=> array( array( 'app', 'core' ),
																		  array( 'module', 'help' )  )
												) 
									),
    );