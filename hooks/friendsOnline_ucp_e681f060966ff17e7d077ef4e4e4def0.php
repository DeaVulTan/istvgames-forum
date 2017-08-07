<?php

/**
 * Product Title:		(SOS34) Friends Online
 * Product Version:		1.3.1
 * Author:				Adriano Faria
 * Website:				SOS Invision
 * Website URL:			http://forum.sosinvision.com.br/
 * Email:				administracao@sosinvision.com.br
 */

class friendsOnline_ucp extends usercpForms_core
{
	public function _customEvent_dofriendsonline()
	{
		if ( !IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['friendsOnline_groups'] ) ) ) )
		{
			$this->registry->output->showError( 'no_permission' );
		}

		$show 	= $this->request['friendsonline_onoff'] ? 1 : 0;

		$this->DB->update( 'members', array( 'friendsonline_onoff' => $show ), 'member_id='.$this->memberData['member_id'] );
		
		return TRUE;
	}

	public function _customEvent_friendsonline()
	{
		if ( IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['friendsOnline_groups'] ) ) ) )
		{
			$show = $this->memberData['friendsonline_forums'];
									
			return $this->registry->output->getTemplate( 'ucp' )->friendsOnline( $show );
		}
		else
		{
			$this->registry->output->showError( 'no_permission' );
		}
	}

	/**
	 * Return links for this tab
	 * You may return an empty array or FALSE to not have
	 * any links show in the tab.
	 *
	 * The links must have 'area=xxxxx'. The rest of the URL
	 * is added automatically.
	 * 'area' can only be a-z A-Z 0-9 - _
	 *
	 * @author	Matt Mecham
	 * @return   array 		array of links
	 */
	public function getLinks()
	{
		$updatedLinks = parent::getLinks();
		
		ipsRegistry::instance()->getClass('class_localization')->loadLanguageFile( array( 'public_usercp' ), 'core' );
		ipsRegistry::instance()->getClass('class_localization')->loadLanguageFile( array( 'public_global' ), 'core' );

		if ( IPSMember::isInGroup( $this->memberData, explode( ',', IPSText::cleanPermString( $this->settings['friendsOnline_groups'] ) ) ) )
		{
			$updatedLinks[] = array( 'url'    => 'area=friendsonline',
									 'title'  => $this->lang->words['friendsOnline'],
									 'active' => $this->request['tab'] == 'core' && $this->request['area'] == 'friendsonline' ? 1 : 0,
									 'area'   => 'friendsonline'
			);
		}

		return $updatedLinks;
	}

	/**
	 * Run custom event
	 *
	 * If you pass a 'do' in the URL / post form that is not either:
	 * save / save_form or show / show_form then this function is loaded
	 * instead. You can return a HTML chunk to be used in the UserCP (the
	 * tabs and footer are auto loaded) or redirect to a link.
	 *
	 * If you are returning HTML, you can use $this->hide_form_and_save_button = 1;
	 * to remove the form and save button that is automatically placed there.
	 *
	 * @author	Matt Mecham
	 * @param	string				Current 'area' variable (area=xxxx from the URL)
	 * @return   mixed 				html or void
	 */
	public function saveForm( $currentArea )
	{
		switch( $currentArea )
		{
			case 'friendsonline':
					return $this->_customEvent_dofriendsonline();
			break;
		}
		
		return parent::saveForm( $currentArea );
	}

	/**
	 * UserCP Form Show
	 *
	 * @author	Matt Mecham
	 * @param	string	Current area as defined by 'get_links'
	 * @param	array   Array of member / core_sys_login information (if we're editing)
	 * @return   string  Processed HTML
	 */
	public function showForm( $current_area, $errors=array() )
	{
		//-----------------------------------------
		// Where to go, what to see?
		//-----------------------------------------
	
		switch( $current_area )
		{
			case 'friendsonline':
				return $this->_customEvent_friendsonline();
			break;
		}
		
		return parent::showForm( $current_area, $errors );
	}
}