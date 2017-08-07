<?php
//------------------------------------------
// CLEANTALK - STOP SPAMMER REGISTRATION v1.1.2
// For IP.Board, by CleanTalk
//------------------------------------------

class cleantalkActionRegister extends public_core_global_register
{

    public function registerProcessForm()
    {

	if(ipsRegistry::$settings['cleantalk_enabled']){
	    require_once(IPS_HOOKS_PATH . 'cleantalk.class.php');

	    session_name('cleantalksession');
	    if (!isset($_SESSION)) {
		session_start();
	    }
	    if (array_key_exists('formtime', $_SESSION)) {
		$submit_time = time() - (int) $_SESSION['formtime'];
	    } else {
		$submit_time = NULL;
	    }
	    $_SESSION['formtime'] = time();
	    $sender_email = filter_var($this->request['EmailAddress'], FILTER_SANITIZE_EMAIL);
	    $sender_ip = $this->member->ip_address;

	    $post_info = '';
	    if(function_exists('json_encode')){
		$arr = array(
		    'cms_lang' => substr($this->lang->local, 0, 2),
		    'REFFERRER' => $_SERVER['HTTP_REFERER'],
		    'USER_AGENT' => $_SERVER['HTTP_USER_AGENT'],
		);
		$post_info = json_encode($arr);
	    }
	    if($post_info === FALSE) $post_info = '';

	    $config_url = 'http://moderate.cleantalk.ru';
	    $config_work_url = defined(ipsRegistry::$settings['cleantalk_work_url']) ? strval(ipsRegistry::$settings['cleantalk_work_url']) : 'http://moderate4.cleantalk.ru';
	    $config_ttl = defined(ipsRegistry::$settings['cleantalk_ttl']) ? intval(ipsRegistry::$settings['cleantalk_ttl']) : 43200;
	    $config_changed = defined(ipsRegistry::$settings['cleantalk_changed']) ? intval(ipsRegistry::$settings['cleantalk_changed']) : 1349162987;

	    $config_key = empty(ipsRegistry::$settings['cleantalk_auth_key']) ? 'enter key' : ipsRegistry::$settings['cleantalk_auth_key'];
	    $config_lang = empty(ipsRegistry::$settings['cleantalk_response_lang']) ? 'en' : ipsRegistry::$settings['cleantalk_response_lang'];

	    $ct_request = new CleantalkRequest();
	    $ct_request->auth_key = $config_key;
	    $ct_request->sender_email = $sender_email;
	    $ct_request->sender_nickname = $this->request['members_display_name'];
	    $ct_request->sender_ip = $sender_ip;
	    $ct_request->post_info = $post_info;
	    $ct_request->agent = 'ipboard-112';
	    $ct_request->response_lang = $config_lang;
	    $ct_request->js_on = $this->request['ct_checkjs'] == md5($config_key . '+' . ipsRegistry::$settings['email_in']) ? 1 : 0;
	    $ct_request->submit_time = $submit_time;

	    $ct = new Cleantalk();
	    $ct->work_url = $config_work_url;
	    $ct->server_url = $config_url;
	    $ct->server_ttl = $config_ttl;
	    $ct->server_changed = $config_changed;

	    $ct_result = $ct->isAllowUser($ct_request);
	
	    if($ct->server_change){
		IPSLib::updateSettings( 
		    array( 
			'cleantalk_work_url' => $ct->work_url,
			'cleantalk_ttl' => $ct->server_ttl,
			'cleantalk_changed' => time()
		    ) 
		);
	    }

	    if($ct_result->allow == 1){
		return parent::registerProcessForm();
	    }else{
		if(!empty($ct_result->errstr) || (!empty($ct_result->inactive) && $ct_result->inactive == 1)){
		    $err_title = ($config_lang == 'ru') ? 'Ошибка хука CleanTalk' : 'CleanTalk hook error';
		    if(empty($ct_result->inactive) && $ct_result->inactive == 1){
			$err_str = preg_replace('/^[^\*]*?\*\*\*|\*\*\*[^\*]*?$/iu', '', $ct_result->comment);
		    }else{
			$err_str = preg_replace('/^[^\*]*?\*\*\*|\*\*\*[^\*]*?$/iu', '', $ct_result->errstr);
		    }

		    $mail_from_addr = 'support@cleantalk.ru';
		    $mail_from_user = 'CleanTalk';
		    $mail_subj = ipsRegistry::$settings['board_name'] . ' - ' . $err_title . '!';
		    $mail_body = '<b>' . ipsRegistry::$settings['board_name'] . ' - ' . $err_title . ':</b><br />' . $err_str;

		    $classToLoad = IPSLib::loadLibrary( IPS_KERNEL_PATH . 'classEmail.php', 'classEmail' );
		    $emailer = new $classToLoad(
						    array('debug'		=> 0,
							  'debug_path'		=> DOC_IPS_ROOT_PATH . '_mail',
							  'smtp_host'		=> ipsRegistry::$settings['smtp_host'] ? ipsRegistry::$settings['smtp_host'] : 'localhost',
							  'smtp_port'		=> intval(ipsRegistry::$settings['smtp_port']) ? intval(ipsRegistry::$settings['smtp_port']) : 25,
							  'smtp_user'		=> ipsRegistry::$settings['smtp_user'],
							  'smtp_pass'		=> ipsRegistry::$settings['smtp_pass'],
							  'smtp_helo'		=> ipsRegistry::$settings['smtp_helo'],
							  'method'		=> ipsRegistry::$settings['mail_method'],
							  'wrap_brackets'	=> ipsRegistry::$settings['mail_wrap_brackets'],
							  'extra_opts'		=> ipsRegistry::$settings['php_mail_extra'],
							  'charset'		=> 'utf-8',
							  'html'		=> 1
							)
		    );
		    $emailer->setFrom( $mail_from_addr, $mail_from_user );
		    $emailer->setTo( ipsRegistry::$settings['email_in'] );
		    $emailer->setSubject( $mail_subj );
		    $emailer->setBody( $mail_body );
		    $emailer->sendMail();
		    $ret_val = parent::registerProcessForm();
		    $member = IPSMember::load( $sender_email, 'members' );
		    if($member){
			IPSMember::save( $member['member_id'], array( 'core' => array( 'member_group_id' => $this->settings['auth_group'] ) ) );
		    }
		    return $ret_val;
		}else{
		    $err_str = '<span style="color:#ab1f39;">' . $ct_result->comment . '</span><script>setTimeout("history.back()", 5000);</script>';
		    if(ipsRegistry::$settings['spam_service_enabled']){
			$ct_resume2log = trim(str_replace('*', '', $ct_result->comment));
			ipsRegistry::DB()->insert( 'spam_service_log', array(
									'log_date'	=> time(),
									'log_code'	=> 4,	// Known spammer
									'log_msg'	=> $ct_resume2log,
									'email_address'	=> $sender_email,
									'ip_address'	=> $sender_ip
									)
			);
		    }
		}
		$this->registry->output->showError($err_str);
		return;
	    }
	}else{
	    return parent::registerProcessForm();
	}
    }
}
