<?php

/**
 * ACP Skins
*/

class cp_skin_converters extends output
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

public function converterInfoError($issue) {

$IPBHTML = "";
//--starthtml--//
if($issue == 'missing')
{
	$title = 'Отсутствуют конвертаторы от IPS';
	$text = 'В вашей инсталляции IP.Board отсутствуют конвертаторы IPS';
}
elseif($issue == 'app')
{
	$title = 'Отсутствует установка конвертаторов';
	$text = 'Отсутствует установка конвертаторов';
}
$IPBHTML .= <<<HTML
<div class='acp-box'>
	<h3>{$title}</h3>
	<div class="warning">
		<p>{$text}, вы не можете продолжать процесс конвертации.</p>
	</div>
</div>
HTML;

//--endhtml--//
return $IPBHTML;
}

public function manualConverterInformation($name) {

$IPBHTML = "";
//--starthtml--//
$form	= array();
$form['host']		= $this->registry->output->formInput('host', $_POST['host'] ? $_POST['host'] : 'localhost' );
$form['username']	= $this->registry->output->formInput('username', $_POST['username'] ? $_POST['username'] : '' );
$form['password']	= $this->registry->output->formInput('password', $_POST['password'] ? $_POST['password'] : '' );
$form['database']	= $this->registry->output->formInput('database', $_POST['dataase'] ? $_POST['database'] : '' );
$form['prefix']		= $this->registry->output->formInput('prefix', $_POST['prefix'] ? $_POST['prefix'] : '' );
$form['charset']	= $this->registry->output->formInput('charset', $_POST['charset'] ? $_POST['charset'] : 'UTF8' );

$IPBHTML .= <<<HTML
<div class='acp-box'>
	<h3>Conversion Information for {$name}</h3>
	<table class="ipsTable double_pad">
		<tbody>
			<tr>
				<th colspan="2">Данные базы данных</th>
			</tr>
			<tr>
				<td class="field_title">
					<strong class="title">MySQL хост</strong>
				</td>
				<td class="field_field">
					{$form['host']}
				</td>
			</tr>
			<tr>
				<td class="field_title">
					<strong class="title">Имя пользователя MySQL</strong>
				</td>
				<td class="field_field">
					{$form['username']}
				</td>
			</tr>
			<tr>
				<td class="field_title">
					<strong class="title">Пароль MySQL</strong>
				</td>
				<td class="field_field">
					{$form['password']}
				</td>
			</tr>
			<tr>
				<td class="field_title">
					<strong class="title">Имя базы данных MySQL</strong>
				</td>
				<td class="field_field">
					{$form['database']}
				</td>
			</tr>
			<tr>
				<td class="field_title">
					<strong class="title">Префикс базы данных</strong>
				</td>
				<td class="field_field">
					{$form['prefix']}
				</td>
			</tr>
			<tr>
				<td class="field_title">
					<strong class="title">Кодировка</strong>
				</td>
				<td class="field_field">
					{$form['charset']}
				</td>
			</tr>
		</tbody>
	</table>
	<div class='acp-actionbar'>
		<div class='centeraction'>
			<a href='{$this->settings['base_url']}module=tools&amp;section=convert&amp;action=process_information' class='button primary'>Continue...</a>
		</div>
	</div>
</div>
HTML;

//--endhtml--//
return $IPBHTML;
}

public function converterChoice($converters) {

$IPBHTML = "";
//--starthtml--//
$form['converter'] = $this->registry->output->formDropdown( 'converter', $converters, $_POST['converter'] ? $_POST['converter'] : '' );

$IPBHTML .= <<<HTML
<div class="warning">
<h4>Please Note</h4>
	<p>Запуск этого инструмента удалит данные аддона Отзывы, которые были ранее конвертированы этим инструментом.</p>
</div><br />
<form id='adminform' action='{$this->settings['base_url']}module=tools&amp;section=convert&amp;action=converter_information' method='post'>
	<input type='hidden' name='_admin_auth_key' value='{$this->registry->getClass('adminFunctions')->_admin_auth_key}' />
	<div class='acp-box'>
		<h3>Choose Converter</h3>
		<table class="ipsTable double_pad">
			<tbody>
				<tr>
					<td class="field_title">
						<strong class="title">Доступные конвертаторы</strong>
					</td>
					<td class="field_field">
						{$form['converter']}
					</td>
				</tr>
			</tbody>
		</table>
		<div class='acp-actionbar'>
 			<div class='centeraction'>
 				<input type='submit' class='button primary' value='Продолжить' />
 			</div>
 		</div>
	</div>
</form>
HTML;

//--endhtml--//
return $IPBHTML;
}
}