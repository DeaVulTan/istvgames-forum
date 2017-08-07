<?php

/**
 * <pre>
 * (Pav32) Post Notes
 * IP.Board v3.2.1
 * Last Updated: August 30, 2011
 * </pre>
 *
 * @author 		Konrad "Pavulon" Szproncel
 * @copyright	(c) 2011 Konrad "Pavulon" Szproncel
 * @link		http://forum.invisionize.pl
 * @version		1.0.6 (Revision 10006)
 */

class postNotesTemplate
{
	public $registry;
	public $lang;
	public $DB;
	public $tagss;
	protected $settings;
	protected $request;
	protected $memberData;

	public function __construct()
	{
		$this->registry		=  ipsRegistry::instance();
		$this->settings		=& $this->registry->fetchSettings();
		$this->request		=& $this->registry->fetchRequest();
		$this->lang		= $this->registry->getClass('class_localization');
		$this->memberData =& $this->registry->member()->fetchMemberData();
		$this->DB		= $this->registry->DB();
	}
	public function getOutput()
	{
		
	}
	public function replaceOutput( $output, $key )
	{
		if ( !$this->settings['pn_enabled'] )
		{
			/* System Offline */
			return $output;
		}
		if ( !in_array($this->memberData['member_group_id'], explode(',', $this->settings['pn_add_groups'] ) ) )
		{
			/* No access */
			return $output;
		}
		ipsRegistry::getClass( 'class_localization')->loadLanguageFile( array( 'public_forums' ) );
		
		/*
		 * Prepare regex and replacement to insert new note button
		 * near report button for users who has access to toggle post visibility button
		 */
		$regex = "/(<li class=[\"']post_edit[\"']><a (?:.*?)id=[\"']edit_post_(\d+)[\"'])/i";
		$img = str_replace( "{style_image_url}", $this->settings['img_url'], $this->registry->output->getReplacement( "compose_icon" ));
		$url = $this->settings['base_url'] . "app=forums&module=extras&section=postNotes&do=form&pid=\\2";

		$toReplace = <<<HTML
<li class='pn-note' style='float:left;'>
	<a id='pn_\\2' href="$url">$img {$this->lang->words['pn_note']}</a>
</li>
HTML;

		/* Regexp used to get post id */
		if ( $output = preg_replace( $regex, "$toReplace\\1", $output ) )
		{
			$js = "<script type='text/javascript' src='{$this->settings['board_url']}/public/js/postnotes.js'></script>\n";

			/* Insert javascript just before </head> */
			$output = str_replace( '</head>', $js.'</head>', $output );
			return $output;
		}
	}
}
