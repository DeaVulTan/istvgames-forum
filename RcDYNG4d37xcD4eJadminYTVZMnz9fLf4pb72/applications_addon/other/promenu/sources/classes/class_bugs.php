<?PHP
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			class_bugs.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

if ( !defined('IN_ACP') )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}
 
class class_bugs
{
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;

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

	
	}	
		
	public function Bugit($do)
	{
		//print_r($this->memberData);
			$IPBHTML .= <<<HTML
			<div class="acp-box">
				<h3>{$this->lang->words['promenu_bug_report']}</h3>
HTML;
		

		if(!$this->request['do'] || $this->request['do'] == "viewmore" || $do == "1")
		{
			$IPBHTML .= <<<HTML
			<br class="clear" />
			<div class='item_info' >
				<span class='no_messages'>{$this->lang->words['promenu_notify_dev']} <a href='{$this->settings['base_url']}module=overview&amp;section=overview&amp;do=bug' class='mini_button'>{$this->lang->words['promenu_file_bug']}</a><br /><br /></span>
			</div>
HTML;
		
		}
		elseif($this->request['do'] == "bug")
		{
			$classToLoad = IPSLib::loadLibrary( IPS_ROOT_PATH . 'sources/classes/editor/composite.php', 'classes_editor_composite' );
			$this->editor = new $classToLoad();
			
			// Lets built thats crumb!!!	
			$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
			$this->registry->output->extra_nav[] = array( $this->settings['base_url'] .'module=overview&amp;section=overview', $this->lang->words['promenu_overview'] );
			$this->registry->output->extra_nav[] = array( $this->settings['base_url'] .'module=overview&amp;section=overview&amp;do=bug', "{$this->lang->words['promenu_bug_report']} -  {$this->lang->words['promenu_submit_bug']}" );
			
			$IPBHTML .= <<<HTML
					<form method='post' action='{$this->settings['base_url']}module=overview&amp;section=overview&amp;do=file'>
						<table class="ipsTable">
							<tr>			
								<td style="width: 100%;text-align: left;" class="ipsControlRow">
									<strong>{$this->lang->words['promenu_contact_email']}</strong><br class="clear"/>
									<input type="" name="contact" id="contact" class="input_text" >
									<br class="clear" />
									<br class="clear" />
									<strong>{$this->lang->words['promenu_bug_report']}:</strong>
									<br class="clear" />
									{$this->editor->show('report',array('editorName' => 'report'))}
									<br /><br />
									<div align='center'><input type="submit" class="realbutton" value="{$this->lang->words['promenu_submit_bug']}"></div>
								</td>
							</tr>
						</table>
					</form>
HTML;
		}
		elseif($do == "return")
		{
			
			// Lets built thats crumb!!!	
			$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
			$this->registry->output->extra_nav[] = array( $this->settings['base_url'] .'module=overview&amp;section=overview', $this->lang->words['promenu_overview'] );
			$this->registry->output->extra_nav[] = array( $this->settings['base_url'] .'module=overview&amp;section=overview&amp;do=return', "{$this->lang->words['promenu_bug_report']} -  {$this->lang->words['promenu_thanks']}" );						
				$IPBHTML .= <<<HTML
						<table class="ipsTable">
							<tr>			
								<td style="width: 100%;text-align: left;" class="ipsControlRow">
									{$this->lang->words['promenu_thanks']}
								</td>
							</tr>
						</table>
HTML;
		}
	
			$IPBHTML .= <<<HTML
					</div>
				<br class="clear" />
HTML;
		if($this->request['do'] == "viewmore")
		{
			$id = intval($this->request['id']);		
			// Lets built thats crumb!!!	
			$this->registry->output->extra_nav[] = array( '', IPSLib::getAppTitle( 'promenu' ) );
			$this->registry->output->extra_nav[] = array( $this->settings['base_url'] .'module=overview&amp;section=overview', $this->lang->words['promenu_overview'] );
			$this->registry->output->extra_nav[] = array( $this->settings['base_url'] .'module=overview&amp;section=overview&amp;do=viewmore&amp;id=' . $id, "{$this->lang->words['promenu_bug_report']} -  {$this->lang->words['promenu_read']}" );	
			$IPBHTML .= <<<HTML
			<div class="acp-box">
				<h3>{$this->lang->words['promenu_bug_report']} -  {$this->lang->words['promenu_read']}</h3>
HTML;
						$this->DB->build( array( 
						'select'	=> '*',
						'from'		=> 'promenu_bugs',
						'where'		=> 'promenu_bugs_id='.$id
					)
				);
				$q = $this->DB->execute();
		
				$bug = $this->DB->fetch( $q );
					
						$member = IPSMember::load($bug['promenu_bugs_submitter']);				
						IPSText::getTextClass('bbcode')->parse_html				= 1;
						IPSText::getTextClass('bbcode')->parse_nl2br			= 1;
						IPSText::getTextClass('bbcode')->parse_smilies			= 1;
						IPSText::getTextClass('bbcode')->parse_bbcode			= 1;
						IPSText::getTextClass('bbcode')->parsing_mgroup			= $this->memberData['member_group_id'];
						IPSText::getTextClass('bbcode')->parsing_mgroup_others	= $this->memberData['mgroup_others'];
						
						$text = IPSText::getTextClass('bbcode')->preDisplayParse($bug['promenu_bugs_report']);
						$text = IPSText::getTextClass('bbcode')->preDisplayParse($text);

						$IPBHTML .= <<<HTML
						<div>
							<strong>{$this->lang->words['promenu_date_filed']}</strong>{$this->lang->formatTime($bug['promenu_bugs_date'])}<br>
							<strong>{$this->lang->words['promenu_by_user']}</strong>{$member['members_display_name']}<br>
							<strong>{$this->lang->words['promenu_report']}</strong>{$text}<br><br><br>
						</div>
HTML;
			$IPBHTML .= <<<HTML
					</div>
				<br class="clear" />
HTML;
		}
		
		return $IPBHTML;
	}
			
	public function deBugit()
	{
		//print_r($this->memberData);
			$bugDisplay = $this->deBugit_Display();
			$IPBHTML .= <<<HTML
			<div class="acp-box">
				<h3>{$this->lang->words['promenu_bugs_reported']}</h3>
					<table class="ipsTable">
						<tr>
							<td style="width:100%;">
HTML;
			if(is_array($bugDisplay))
			{
				
				foreach($bugDisplay as $key => $bug)
				{
					
						IPSText::getTextClass('bbcode')->parse_html				= 1;
						IPSText::getTextClass('bbcode')->parse_nl2br			= 1;
						IPSText::getTextClass('bbcode')->parse_smilies			= 1;
						IPSText::getTextClass('bbcode')->parse_bbcode			= 1;
						IPSText::getTextClass('bbcode')->parsing_mgroup			= $this->memberData['member_group_id'];
						IPSText::getTextClass('bbcode')->parsing_mgroup_others	= $this->memberData['mgroup_others'];
				
						$length = 20; // The number of words you want
						$text = IPSText::getTextClass('bbcode')->preDisplayParse($bug['promenu_bugs_report']);
						$text = IPSText::getTextClass('bbcode')->preDisplayParse($text);
						$wc   = str_word_count(strip_tags($text));
						$words = explode(' ', strip_tags($text)); // Creates an array of words
						$words = array_slice($words, 0, $length);
						$text = implode(' ', $words);

						$member = IPSMember::load($bug['promenu_bugs_submitter']);

						
						if($wc >= $length)
						{

							$readmore = "<a href='{$this->settings['base_url']}module=overview&amp;section=overview&amp;do=viewmore&id={$bug['promenu_bugs_id']}'>...{$this->lang->words['promenu_read']}</a>";

						}
						else
						{
							$readmore = "<br><a href='{$this->settings['base_url']}module=overview&amp;section=overview&amp;do=viewmore&id={$bug['promenu_bugs_id']}'>{$this->lang->words['promenu_view_html']}</a>";
						}

						
						$IPBHTML .= <<<HTML
						<div >
							<strong>{$this->lang->words['promenu_date_filed']}</strong>{$this->lang->formatTime($bug['promenu_bugs_date'],"long",0)}<div class='col_buttons right'><div class='icon delete'><a href='{$this->settings['base_url']}{$this->form_code}do=delete&amp;id={$bug['promenu_bugs_id']}'>{$this->lang->words['promenu_report_delete']}</a></div></div><br>
							<strong>{$this->lang->words['promenu_by_user']}</strong>{$member['members_display_name']}<br>
							<strong>{$this->lang->words['promenu_report']}</strong>{$text}{$readmore}
							<div style="height:1.5em;border-bottom: 1px solid #000;"></div>
							<br>
							<br>
						</div>
HTML;
				}
			}
			else
			{

			$IPBHTML .= <<<HTML
				<div><strong>{$this->lang->words['promenu_no_bugs']}</strong></div>
HTML;
			}
							
			$IPBHTML .= <<<HTML
							</td>

						</tr>
					</table>
			</div>
HTML;

		return $IPBHTML;
	}
	
	public function deBugit_Display()
	{

			$this->DB->build( array( 
			'select'	=> '*',
			'from'		=> 'promenu_bugs',
			'order'	=> 'promenu_bugs_date desc'
					)
				);

		$q = $this->DB->execute();
		
		while( $bug = $this->DB->fetch( $q ) )
		{
			$bugDisplay[] = $bug;
		}
		
		return $bugDisplay;
	}
	

}

?>
