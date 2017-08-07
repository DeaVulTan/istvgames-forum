<?php
/**
 * ProMenu
 * Provisionists LLC
 *  
 * @ Package : 			ProMenu
 * @ File : 			cp_skin_overview.php
 * @ Last Updated : 	Apr 17, 2012
 * @ Author :			Robert Simons
 * @ Copyright :		(c) 2011 Provisionists, LLC
 * @ Link	 :			http://www.provisionists.com/
 * @ Revision : 		2
 */

class cp_skin_overview extends output
{
	/* We must declare a destructor */
	public function __destruct()
	{
	}

	public function overview($do)
	{

	/* Lets build some counts */		
	$parents = $this->DB->buildAndFetch( array( 'select' => 'COUNT(promenu_id) as count', 'from' => 'promenu', 'where' => "promenu_parent_id = '0'" ) );
	$children = $this->DB->buildAndFetch( array( 'select' => 'COUNT(promenu_id) as count', 'from' => 'promenu', 'where' => "promenu_parent_id > '0'" ) );
	$all = $parents['count'] + $children['count'];		
		$IPBHTML = "";
		//--starthtml--//
		
		$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>{$this->lang->words['promenu_overview']}: {$this->lang->words['promenu_title']}</h2>
</div>
<table width='90%' valign='top' align='left'>
	<tr>
		<td width='60%' valign='top'>
			<div class='acp-box'>
				<h3>{$this->lang->words['promenu_latest']}</h3>
					<div class='information-box' style='text-align:left'>
						No News
					</div>
			</div>
			<br class="clear" />
HTML;
		$IPBHTML .= <<<HTML
		</td>
		<td width='2%'></td>
		<td width='38%' valign='top'>
			<div class="acp-box">
				<h3>{$this->lang->words['promenu_general_info']}</h3>

				<table class="ipsTable">
					<tr>
						<td style="width: 40%;"><strong>{$this->lang->words['promenu_version']}</strong></td>
						<td style="width: 60%; text-align: center;">{$this->caches['app_cache']['promenu']['app_version']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['promenu_menu_parent_total']}</strong></td>
						<td align='center'>{$parents['count']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['promenu_menu_child_total']}</strong></td>
						<td align='center'>{$children['count']}</td>
					</tr>
					<tr>
						<td><strong>{$this->lang->words['promenu_menu_total']}</strong></td>
						<td align='center'>{$all}</td>
					</tr>
				</table>

			</div>
			<br class="clear" />
HTML;
		/* Lets show any bug reports we might have */	
		$IPBHTML .= $this->registry->getClass('class_bugs')->deBugit();
		$IPBHTML .= <<<HTML
		</td>
	</tr>
</table>
HTML;
		//--endhtml--//
		return $IPBHTML;
	}
}
