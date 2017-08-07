<?php
if(!defined('IN_ACP'))
{
	print "<h1>Ошибка доступа</h1>Вы не можете получить доступ к этому файлу непосредственно. Если вы недавно обновились, убедитесь, что вы обновили 'admin.php'.";
	exit();
}

class admin_jawards_awards_perms extends ipsCommand
{
	function doExecute(ipsRegistry $registry)
	{
		if($this->settings['jawards_disable_public_awding'])
		{
			$url = $this->settings['base_url'];
			$url = str_replace('app=jawards', 'app=core', $url);

			$this->registry->getClass('output')->html_main .= "
			<div class='warning'>
			  <h4>Внимание!</h4>
			  Вы отключили публичное награждение, которое управлется этими настройками! Включите для продолжения.<br />
			  <br />
			  <a href='{$url}module=settings&section=settings&do=findsetting&key=publicawarding'>Нажмите здесь, чтобы изменить настройки</a>
			</div>";

			$this->registry->getClass('output')->sendOutput();
		}

		# Set some stuff
		$imagePermOK = "<img src='{$this->settings['skin_acp_url']}/images/icons/tick.png' title='Отключить возможность для группы' />";
		$imagePermNO = "<img src='{$this->settings['skin_acp_url']}/images/icons/cross.png' title='Включить возможность для группы' />";

		$this->registry->getClass('output')->html_main .= "
		<div class='section_title'>
		  <h2>Права групп</h2>
	    </div>";

		# Get the groups
		$this->DB->build(array(
							   'select' => '*',
							   'from'   => 'groups',
							   'order'  => 'g_id ASC',
		));

		$this->DB->execute();

		while($g = $this->DB->fetch())
		{
			if($g['g_jlogica_awards_can_give'])
			{
				$give = $imagePermOK;
			}
			else
			{
				$give = $imagePermNO;
			}

			if($g['g_jlogica_awards_can_remove'])
			{
				$remove = $imagePermOK;
			}
			else
			{
				$remove = $imagePermNO;
			}

			if($g['g_jlogica_awards_can_receive'])
			{
				$receive = $imagePermOK;
			}
			else
			{
				$receive = $imagePermNO;
			}

			$givePerms   .= "
			giveAwdPerms[{$g['g_id']}] = {$g['g_jlogica_awards_can_give']};";
			$removePerms .= "
			removeAwdPerms[{$g['g_id']}] = {$g['g_jlogica_awards_can_remove']};";
			$receivePerms .= "
			receiveAwdPerms[{$g['g_id']}] = {$g['g_jlogica_awards_can_receive']};";

			if($g['g_access_cp'])
			{
				$note = " ( <em>По умолчанию разрешено</em> )";
			}

			$rows .= "
			<tr>
			  <td>{$g['prefix']}{$g['g_title']}{$g['suffix']}{$note}</td>
			  <td align='center'><a href='javascript: updatePerm(\"give\", {$g['g_id']});' id='give_{$g['g_id']}'>{$give}</a></td>
			  <td align='center'><a href='javascript: updatePerm(\"remove\", {$g['g_id']});' id='remove_{$g['g_id']}'>{$remove}</a></td>
			  <td align='center'><a href='javascript: updatePerm(\"receive\", {$g['g_id']});' id='receive_{$g['g_id']}'>{$receive}</a></td>
			</tr>";

			unset($note);
		}

		$this->registry->getClass('output')->html_main .= "
		<script type='text/javascript'>
		var stylesURL = '{$this->settings['skin_acp_url']}';
		var OKimg     = \"{$imagePermOK}\";
		var NOimg     = \"{$imagePermNO}\";

		var giveAwdPerms    = [];
		var removeAwdPerms  = [];
		var receiveAwdPerms = [];{$givePerms}{$removePerms}{$receivePerms}
		</script>
		<script type='text/javascript' src='applications_addon/other/jawards/js/perms.js'></script>
		<div class='information-box' style='margin-bottom:15px;'>
		  <h4>Помощь по этой странице</h4>
		  {$imagePermOK} = Группа имеет разрешение, нажмите на значок чтобы отключить<br />
		  {$imagePermNO} = Группа НЕ имеет разрешения, нажмите на значок чтобы включить<br />
		  <br />
		  Вы можете выбрать какая группа будет иметь право выдавать награды, изменять и получать.
		</div>
		<div class='acp-box'>
		  <h3>Группы пользователей</h3>
		  <table class='ipsTable double_pad'>
		    <tr>
			  <th width='25%'>Название группы</th>
			  <th width='25%'><div align='center'>Могут выдавать награды</div></th>
			  <th width='25%'><div align='center'>Могут удалять награды</div></th>
			  <th width='25%'><div align='center'>Могут получать награды</div></th>
			</tr>
		    {$rows}
		  </table>
		</div>";

		$this->registry->getClass('output')->sendOutput();
	}
}
