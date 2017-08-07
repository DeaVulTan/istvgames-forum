<?php

class cleantalkLibrary{

    const BASE_CLASS = 'cleantalk.class.php';
    const XMLRPC_CLASS = 'cleantalk.xmlrpc.php';

    public function install(){
	$file = file_get_contents('http://cleantalk.ru/files/base/020/cleantalk.class.php');
	if($file === FALSE){
	    return FALSE;
	}
	if(file_put_contents(IPS_HOOKS_PATH . self::BASE_CLASS , $file) === FALSE){
	    return FALSE;
	}

	$file = file_get_contents('http://cleantalk.ru/files/base/cleantalk.xmlrpc.php');
	if($file === FALSE){
	    return FALSE;
	}
	if(file_put_contents(IPS_HOOKS_PATH . self::XMLRPC_CLASS , $file) === FALSE){
	    return FALSE;
	}

	return TRUE;
    }

    public function uninstall(){
	unlink(IPS_HOOKS_PATH . self::BASE_CLASS);
	unlink(IPS_HOOKS_PATH . self::XMLRPC_CLASS);
	return TRUE;
    }
}
