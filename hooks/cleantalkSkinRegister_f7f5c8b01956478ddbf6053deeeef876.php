class cleantalkSkinRegister extends skin_register(~id~)
{
    public function registerForm($general_errors, $data, $inline_errors, $time_select, $custom_fields, $nexusFields, $nexusStates)
    {
	$IPBHTML = '';
	if(ipsRegistry::$settings['cleantalk_enabled']){
	    $config_key = empty(ipsRegistry::$settings['cleantalk_auth_key']) ? 'enter key' : ipsRegistry::$settings['cleantalk_auth_key'];
	    session_name('cleantalksession');
	    if (!isset($_SESSION)) {
		session_start();
	    }
	    $_SESSION['formtime'] = time();
	    $form_id = 'register';
	    $IPBHTML = "\n";
	    $IPBHTML .= '<script type="text/javascript">' . "\n";
	    $IPBHTML .= '// <![CDATA[' . "\n";
	    $IPBHTML .= 'form = document.getElementById("' . $form_id. '");' . "\n";
	    $IPBHTML .= 'if(form){' . "\n";
	    $IPBHTML .= "\t" . 'e_in = document.createElement("INPUT");' . "\n";
	    $IPBHTML .= "\t" . 'e_in.setAttribute("type", "hidden");' . "\n";
	    $IPBHTML .= "\t" . 'e_in.setAttribute("id", "ct_checkjs");' . "\n";
	    $IPBHTML .= "\t" . 'e_in.setAttribute("name", "ct_checkjs");' . "\n";
	    $IPBHTML .= "\t" . 'e_in.setAttribute("value", "0");' . "\n";
	    $IPBHTML .= "\t" . 'form.appendChild(e_in);' . "\n";
	    $IPBHTML .= "\t" . 'setTimeout("document.getElementById(\'ct_checkjs\').value = document.getElementById(\'ct_checkjs\').value.replace(\'0\', \'' . md5($config_key . '+' . ipsRegistry::$settings['email_in']) . '\');",1000)' . "\n";
	    $IPBHTML .= '}' . "\n";
	    $IPBHTML .= '// ]]>' . "\n";
	    $IPBHTML .= '</script>' . "\n\n";
	}
	
	return parent::registerForm($general_errors, $data, $inline_errors, $time_select, $custom_fields, $nexusFields, $nexusStates) . $IPBHTML;
    }
}
