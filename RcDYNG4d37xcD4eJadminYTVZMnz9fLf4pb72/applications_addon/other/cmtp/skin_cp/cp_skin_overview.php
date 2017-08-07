<?PHP
/**
 * @ Application : 		Custom Moderator Team Page v2.0.0
 * @ Last Updated : 	June 13th, 2012 
 * @ Author :			Michael S. Edwards
 * @ Copyright :		(c) 2011 Coding Jungle
 * @ Link	 :			http://www.codingjungle.com/
 */
class cp_skin_overview extends output {

	/* We must declare a destructor */

	public function __destruct() {

	}

	public function JavascriptGroups() {

		$acp = CP_DIRECTORY;

	}

	public function overview() {

		$html = "";

		$html .= <<<HTML

			<div class='section_title'>

				<h2>{$this->lang->words['cmtp_php_OverView']}</h2>

			</div>

			<table width='90%' valign='top' align='left'>

				<tr>

HTML;

		$app	= $this->cache->GetCache('app_cache');
		$html .= <<<HTML

					<td width='2%'></td>

					<td width='60%' valign='top'>

						<div class="acp-box">

							<h3>{$this->lang->words['cmtp_php_GeneralInfo']}</h3>

								<table class="ipsTable">

									<tr>

										<td style="width: 40%;"><strong>{$this->lang->words['cmtp_php_Installed']}</strong></td>

										<td style="width: 60%; text-align: center;">{$this->caches['app_cache']['cmtp']['app_version']}

										</td>

									</tr>
									<tr>
										<td style="width: 40%;"><strong>{$this->lang->words['cmtp_php_CurrentVersion']}</strong></td>
									</tr>
								</table>

						</div>

						<br>

					</td>

				</tr>

			</table>

HTML;

		//--endhtml--//

		return $html;

	}

}
