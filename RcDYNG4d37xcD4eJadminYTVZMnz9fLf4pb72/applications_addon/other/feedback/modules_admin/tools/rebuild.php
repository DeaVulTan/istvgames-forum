<?php

/**
 * Rebuild various
*/

if ( ! defined( 'IN_ACP' ) )
{
    print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
    exit();
}

class admin_feedback_tools_rebuild extends ipsCommand
{
	public $perCycle = 50;

    /**
     * Class entry point
     *
     * @access	public
     * @param	object		Registry reference
     * @return	void		[Outputs to screen/redirects]
     */
    public function doExecute( ipsRegistry $registry )
    {
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_feedback' );
		switch($this->request['action'])
		{
			default:
				$this->rebuildForm();
			break;
			case 'feedback':
				$this->rebuildFeedback();
			break;
		}

        $this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
        $this->registry->output->sendOutput();
    }

	public function rebuildForm()
	{
		$this->html->form_code = 'module=tools&amp;section=rebuild&amp;action=feedback';
		$this->registry->output->html .= $this->html->rebuildForm( );
	}

	public function rebuildFeedback()
	{
		$done = isset($this->request['done']) ? intval($this->request['done']) : 0;

		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'feedback' ) . "/sources/feedbackLib.php", 'feedbackLib', 'feedback' );
		$this->registry->feedback = new $classToLoad( $this->registry );

		$c = $this->DB->buildAndFetch(array('select' => 'count(m.member_id) as cnt',
											'from'   => array( 'members' => 'm' )));

		$this->DB->build(array(	'select' => 'm.*',
								'from'   => array( 'members' => 'm' ),
								'order'	 => 'member_id ASC',
								'limit'	 => array($done, $this->perCycle)));
		$q = $this->DB->execute();

		if(!$this->DB->getTotalRows($q))
		{
			/* Rebuild the Index Cache*/
			require_once(IPSLib::getAppDir( 'feedback' ).'/sources/cache.php');
			$c = new feedbackCache($this->registry);
			$c->indexStatistics();

			$this->registry->output->global_message = $done. ' Profiles have been rebuilt.';
			$this->rebuildForm();
			return;
		}

		while($m = $this->DB->fetch($q))
		{
			/* Do the recount */
			$this->registry->feedback->recountMembersScore($m['member_id']);
			$done++;
		}
		
		$txt = 'Rebuilt '.$done.' profiles of  '.$c['cnt'];

		$this->_redirect( $this->settings['base_url']."module=feedback&amp;module=tools&amp;section=rebuild&amp;action=feedback&amp;done={$done}", $txt );
	}

	private function _redirect($url, $text, $time=2)
	{
		$this->registry->output->html		= $this->registry->output->global_template->temporaryRedirect( $url, $text, $time );
		$this->registry->output->html_main	.= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
		return;
	}
}