<?php

/**
 * FURL Templates
*/

$_SEOTEMPLATES = array(
    	'feedbackLeave'	=> array(
		'app'			=> 'feedback',
		'allowRedirect' => 1,
		'out'			=> array( '#app=feedback(&|&amp;)module=view(&|&amp;)action=leave&amp;do=(\d+?)$#i', 'feedback/leave-feedback/$3-#{__title__}' ),
		'in'			=> array(
			'regex'			=> "#^/feedback/leave-feedback/(\d+?)-#i",
			'matches'		=> array(	array( 'app', 'feedback' ),
										array( 'module', 'view'),
										array( 'section', 'view'),
										array( 'action', 'leave'),
										array( 'do', '$1')
		)
	)),
    	'feedbackFind'	=> array(
		'app'			=> 'feedback',
		'allowRedirect' => 1,
		'out'			=> array( '#app=feedback(&|&amp;)module=view(&|&amp;)action=find-member$#i', 'feedback/find-member' ),
		'in'			=> array(
			'regex'			=> "#^/feedback/find-member#i",
			'matches'		=> array(	array( 'app', 'feedback' ),
										array( 'module', 'view'),
										array( 'section', 'view'),
										array( 'action', 'find-member')
		)
	)),
    	'feedbackUser'	=> array(
		'app'			=> 'feedback',
		'allowRedirect' => 1,
		'out'			=> array( '#app=feedback(&|&amp;)module=view(&|&amp;)action=show-user(&|&amp;)do=(\d+?)$#i', 'feedback/users/$4-#{__title__}' ),
		'in'			=> array(
			'regex'			=> "#^/feedback/users/(\d+?)-#i",
			'matches'		=> array(	array( 'app', 'feedback' ),
										array( 'module', 'view'),
										array( 'section', 'view'),
										array( 'action', 'show-user'),
										array( 'do', '$1' )
		)
	)),
    	'feedback'	=> array(
		'app'			=> 'feedback',
		'allowRedirect' => 1,
		'out'			=> array( '#app=feedback#i', 'feedback/' ),
		'in'			=> array(
			'regex'			=> "#^/feedback#i",
			'matches'		=> array( array( 'app', 'feedback' ) )
		)
	),
    );