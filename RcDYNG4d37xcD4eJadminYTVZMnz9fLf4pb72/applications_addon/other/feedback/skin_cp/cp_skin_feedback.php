<?php

/**
 * ACP Skins
*/

class cp_skin_feedback extends output
{

/**
 * Prevent our main destructor being called by this class
 *
 * @access	public
 * @return	void
 */
public function __destruct()
{
}

public function feedbackPermissions($form) {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<div class='section_title'>
	<h2>Управление правами аддона Отзывы</h2>
</div>


<form id='adminform' action='{$this->settings['base_url']}{$this->form_code}' method='post'>
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->getClass('adminFunctions')->_admin_auth_key}' />

	<div class='acp-box'>
 		{$form['perm_matrix']}
 		<div class='acp-actionbar'>
 			<div class='centeraction'>
 				<input type='submit' class='button primary' value='Сохранить' />
 			</div>
 		</div>
	</div>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}

public function rebuildForm() {

$IPBHTML = "";
//--starthtml--//

$IPBHTML .= <<<HTML
<form id='adminform' action='{$this->settings['base_url']}{$this->form_code}' method='post'>
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->getClass('adminFunctions')->_admin_auth_key}' />
	<div class='acp-box'>
	<h3>Перекеширование данных профиля</h3>
	<p class='pad'>Этот инструмент пересчитает и перекеширует данные отзывов в профилях пользователей (и в темах форума).</p>
 		<div class='acp-actionbar'>
 			<div class='centeraction'>
 				<input type='submit' class='button primary' value='Выполнить' />
 			</div>
 		</div>
	</div>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}
}